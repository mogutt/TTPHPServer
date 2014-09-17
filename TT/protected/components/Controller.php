<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to 'column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    /**
     * 上传图片返回上传路径
     * $name file类型input 的name
     */
    public function upload($filename){
        if(empty($filename))
            return '';
 	    $image = CUploadedFile::getInstanceByName($filename);

        // $name = '/media/psf/Home/Sites/im/TT/uploadImage'.'/'.time().mt_rand(0,99999).$image->name;
        $name = dirname(Yii::app()->request->scriptFile).'/uploadImage/'.time().mt_rand(0,99999).$image->name;
	    if(!empty($name)){
		    //验证图片后缀
		    if(!in_array($image->type,array('image/jpeg','image/jpg','image/png'),true)){
			    return ;
		    }
	    }
        $image->saveAs($name);
        $domain = Yii::app()->params['uploadSite'];
        if(empty($name)){
            return '';
        }
        //图片文件上传调用接口
        $data = array('txt' => '@'.$name);
        $ch = curl_init($domain);
              curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
              curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
        $data = curl_exec($ch);//运行curl
              curl_close($ch);
        $data = json_decode($data);
        // var_dump($data);
        return $data->path;
    }

    public function _upload($name){
        $domain = Yii::app()->params['uploadSite'];
        //图片文件上传调用接口
        $data = array('txt' => '@'.$name);
        $ch = curl_init($domain);
              curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
              curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
              curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
              curl_setopt($ch, CURLOPT_FOLLOWLOCATION , 1);
        $data = curl_exec($ch);//运行curl
              curl_close($ch);
        $data = json_decode($data);
        return $data->path;
    }


    public function image(){
        if(!$_FILES['data']['tmp_name']['mod_avatar']){
            return false;
        }
       $targ_w = $targ_h = 400;
       $jpeg_quality = 90;
       $src = $_FILES['data']['tmp_name']['mod_avatar'];
       $size = getimagesize($_FILES['data']['tmp_name']['mod_avatar']);
       if($size[0] > $size[1]){
           $radio = $size[0] / 200;
       }else{
           $radio = $size[1] / 200;
       }
       $x = $_POST['x'] * $radio;
       $y = $_POST['y'] * $radio;
       $w = $_POST['w'] * $radio;
       $h = $_POST['h'] * $radio;
       // var_dump($radio);
       // var_dump($x);
       // exit();
       $img_r = imagecreatefromjpeg($src);
       $dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

       imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
       $file_name = dirname(Yii::app()->request->scriptFile).'/uploadImage/'.time().mt_rand(0,99999).$_FILES['data']['name']['mod_avatar'];
       imagejpeg($dst_r, $file_name, $jpeg_quality);
       return $file_name;
    }

    /**
     * 群组类型
     */
    public function groupType($type){
       switch($type){
           case 1:
               return '固定';
           break;
           case 2:
               return '临时';
           break;
       }
    }

    /**
     * 状态类型
     */
    public function showStatus($type){
        switch($type){
            case 0:
                return '正常';
                break;
            case 1:
                return '禁用';
                break;
        }
    }

    /**
     * 获取缓存
     *
     */
    public function getDepartCache(){
        $departs = IMDepartment::model()->findAll(array(
            'condition' => 'status = 0',
        ));
        foreach($departs as $k => $v){
            $cache[$k]['id'] = $v->id;
            $cache[$k]['title'] = $v->title;
            $cache[$k]['desc'] = $v->desc;
            $cache[$k]['pid'] = $v->pid;
            $cache[$k]['leader'] = $v->leader;
        }
        if(!empty($cache))
            Yii::app()->cache->set('cache_depart',$cache);

        return $cache;
    }

    /**
     * 获取用户缓存
     *
     */
    public function getUserCache(){
        $users = IMUsers::model()->findAll(array(
            'condition' => 'status = 0',
        ));
        foreach($users as $k => $v){
            $cache[$k]['userId'] = $v->id;
            $cache[$k]['title'] = $v->title;
            $cache[$k]['uname'] = $v->uname;
        }
        if(!empty($cache))
            Yii::app()->cache->set('cache_user',$cache);
        return $cache;
    }

    /**
     * 获取管理员缓存
     */
    public function getAdminCache(){
        $adminInfo = IMAdmin::model()->findAll(array(
            'condition' => 'status = 0',
        ));
	if(empty($adminInfo)){
	    $adminInfo = new IMAdmin();
	    $adminInfo->uname = Yii::app()->params['defaultAdminUname'];
	    $adminInfo->pwd = md5(Yii::app()->params['defaultAdminPwd']);	
	    $adminInfo->status = 0;
	    $adminInfo->created = time();
	    if($adminInfo->save()){
		    $cache['id'] = $adminInfo->id;
		    $cache['uname'] = $adminInfo->uname;
		    $cache['pwd'] = $adminInfo->pwd;
			
		if(!empty($cache))
		    Yii::app()->cache->set('cache_admininfo',$cache);
        	return $cache;
	    }
	}
        foreach($adminInfo as $k => $v){
            $cache[$k]['id'] = $v->id;
            $cache[$k]['uname'] = $v->uname;
            $cache[$k]['pwd'] = $v->pwd;
        }
        if(!empty($cache))
            Yii::app()->cache->set('cache_admininfo',$cache);
        return $cache;
    }

    /**
     * 获取部门级别
     *
     */
    public function getDepartLevel($pid){
        if($pid == 0){
            return '父级部门';
        }
        $departInfo = Yii::app()->cache->get('cache_depart');
        if(empty($departInfo))
        {
            $departInfo = $this->getDepartCache();
        }
        foreach($departInfo as $k => $v){
            if($v['id'] == $pid){
                return $v['title'];
            }
        }
    }

    /**
     * 判断用户身份
     */
    public function getUserInfo($userId){
        if($userId == 0){
            return '管理员';
        }
        $users = Yii::app()->cache->get('cache_user');
        if(empty($users)){
            $users = $this->getUserCache();
        }
        foreach($users as $k => $v){
            if($v['userId'] == $userId){
                return $v['uname'];
            }else{
                return '未知用户';
            }
        }
    }

    /**
     * curl模块
     * $site curl的接口url
     * $userList “user_list”: [1,2,3,4,5,6]
     * $groupName urlEncode
     */
    public function sendGroupInterface($groupId,$userList,$groupName,$groupAvatar){

        $domain = Yii::app()->params['sendGroupInfodomain'];
        $userLists = array();
        if(!empty($userList)){
            foreach($userList as $v){
                if(!empty($v))
                    $userLists[] = intval($v);
            }
        }

        if(empty($userLists))
            return ;
        $curlPost = json_encode(array('group_id' => intval($groupId),'user_list' => $userLists,'group_name' => urlencode($groupName),'group_avatar' => $groupAvatar));

        $ch = curl_init();//初始化curl
        curl_setopt($ch,CURLOPT_URL,$domain);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
    }

/**
*更新接口
*/
    public function updateGroupInterface($groupId,$userList){

        $domain = Yii::app()->params['updateGroupInfodomain'];
        $userLists = array();
        if(!empty($userList)){
            foreach($userList as $v){
                if(!empty($v))
                    $userLists[] = intval($v);
            }
        }

        if(empty($userLists))
            return ;
        $curlPost = json_encode(array('group_id' => intval($groupId),'user_list' => $userLists));

        $ch = curl_init();//初始化curl
        curl_setopt($ch,CURLOPT_URL,$domain);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
    }

    /**
     * 输出成功信息
     */
    public function showAlert($type = 'success',$msg){

        switch($type){
            case 'success':
                if(empty($msg))
                    $msg = '操作成功';
                echo '<div class="alert alert-success" role="alert">'.$msg.'</div>';
                break;
            case 'fail' :
                if(empty($msg))
                    $msg = '操作失败';
                echo '<div class="alert alert-danger" role="alert">'.$msg.'</div>';
                break;
            default :
                break;

        }
    }
    //输出图片
    public function showImg($imgUrl){
        if(empty($imgUrl))
            return 'images/avtar.jpg';
        $domain = Yii::app()->params['uploadSite'];
        return $domain.$imgUrl;
    }

    //输出部门名称
    public function getDepartName($departId){
        $departIds = Yii::app()->cache->get('cache_depart');
        if(empty($departIds))
            $departIds = $this->getDepartCache();

        if(!empty($departIds)){
            foreach($departIds as $v)
            {
                if($v['id'] == $departId){
                    return $v['title'];
                }
            }
        }
    }

    //输出性别
    public function getSex($type){
        if(!isset($type))
            return '男';
        if($type == 1)
            return '男';
        elseif($type == 0)
            return '女';
        else
            return '外星人';
    }

}
