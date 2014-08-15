<?php
/**
 * Project: yiiim
 * File: DepartController.php
 * User: 明心
 * Date: 14-8-7
 * Time: 下午2:17
 * Desc: 
 */

 class AdminController extends Controller{

     /**
      * 管理员添加
      */
     public function actionAdd(){
         if(Yii::app()->request->isPostRequest){

             $oldadmin = IMAdmin::model()->find(array(
                'order' => 'id DESC',
                'limit' => 1,
             ));
             $data = Yii::app()->request->getPost('data');
             if($oldadmin->pwd == md5($data['oldpwd'])){
                 if($data['newpwd1'] == $data['newpwd2']){
                    $oldadmin->uname = $data['uname'];
                     $oldadmin->pwd = md5($data['newpwd1']);
                     $oldadmin->updated = time();
                     if($oldadmin->update()){
			     $this->showAlert('success','操作成功');
                             $this->getAdminCache();
                         }else{
			     $this->showAlert('fail','操作失败');
                             echo $admin->getErrors();
                         }
                 }else{
		     $this->showAlert('fail','2次密码不一致');
                 }
             }else{
		     $this->showAlert('fail','原始密码错误');
             }
         }

         $this->render('add',array(

         ));
     }
 }
