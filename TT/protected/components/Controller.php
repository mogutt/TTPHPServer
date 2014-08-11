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

        $image = CUploadedFile::getInstanceByName($filename);
        $name = Yii::app()->params['uploadPath'].'/'.mt_rand(0,99999).$image->name;
        $image->saveAs($name);
        return $name;

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
            case 1:
                return '正常';
                break;
            case 0:
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
            'condition' => 'status = 1',
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
            'condition' => 'status = 1',
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
            'condition' => 'status = 1',
        ));
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
}