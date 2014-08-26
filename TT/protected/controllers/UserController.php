<?php
/**
 * Project: yiiim
 * File: UserController.php
 * User: 明心
 * Date: 14-8-4
 * Time: 下午5:09
 * Desc: 用户控制类
 */
 class UserController extends Controller{

     public function actionAdd(){

        if(Yii::app()->request->isPostRequest){

            $user = new IMUsers();
            $data = Yii::app()->request->getPost('data');
            $user->attributes = $data;
            $user->pwd = md5($data['pwd']);
            if($_FILES['data']['tmp_name']['mod_avatar']){
                $user->avatar = $this->upload('data[mod_avatar]');
            }else{
                $user->avatar = '';
            }
            $time = time();
            $user->departId = $data['departId'];
            $user->status = $data['status'];
            $user->created = $time;
            $user->updated = $user->created;
	   
            if($user->save())
            {
                $this->showAlert('success','添加成功');
                $this->getUserCache();
            }else{
                $this->showAlert('fail','添加失败,请添加完整信息');
            }
        }
         $departs = Yii::app()->cache->get('cache_depart');
         if(empty($departs))
         {
            $departs = $this->getDepartCache();
         }

         $this->render('add',array(
             'departs' => $departs,
         ));

     }

     /**
      * 用户列表
      */
     public function actionList($page = 1){

        $count = IMUsers::model()->count(array(
            'condition' => 'status = 0',
        ));
        $pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['perPage'];

        if(empty($page))
            $pager->currentPage = 1;

        $list = IMUsers::model()->findAll(array(
            'order' => 'id DESC',
            'condition' => 'status = 0',
            'offset' => $pager->getCurrentPage()*$pager->getPageSize(),
            'limit' => $pager->pageSize,
        ));

        foreach($list as $v){
            $data[] = $v->attributes;
        }

        $this->render('list',array(
            'list' => $data,
            'pager' => $pager,
        ));

     }

    /**
     * 删除用户
     */
     public function actionDel($id){

         if(empty($id))
             return;
         $user = IMUsers::model()->findByPk($id);
         $user->status = 0;

         if($user->save()){
             echo '<div class="alert alert-success" role="alert">删除成功</div>';
         }else{
             echo '<div class="alert alert-danger" role="alert">删除失败</div>';
         }

     }

     /**
      * 修改用户信息
      */
     public function actionEdit($id){

         if(empty($id))
             return;
         $user = IMUsers::model()->findByPk($id);

         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');
             $file = $this->image();

             $user->attributes = $data;

             if($user->pwd != $data['pwd'])
                $user->pwd = md5($data['pwd']);

            if($_FILES['data']['tmp_name']['mod_avatar']){
                $user->avatar = $this->_upload($file);
            }

             $user->departId = $data['departId'];
             $user->status = $data['status'];
             $time = time();
             $user->updated = $time;
             if($user->update()){
                 $this->showAlert('success','修改成功');
                 //更新用户之后更新用户缓存
                 $this->getUserCache();
             }else{
                 $this->showAlert('fail','修改失败');
             }
         }
         $departs = Yii::app()->cache->get('cache_depart');
         $this->render('add',array(
             'data' => $user,
             'departs' => $departs,
         ));
     }

 }
