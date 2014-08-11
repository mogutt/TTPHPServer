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
      * 组织架构添加
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
                             echo '<div class="alert alert-success" role="alert">添加成功</div>';
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

                         }else{
                             echo $admin->getErrors();
                             echo '<div class="alert alert-danger" role="alert">添加失败</div>';
                         }
                 }else{
                     echo '<div class="alert alert-danger" role="alert">2次密码不一致</div>';
                 }
             }else{
                 echo '<div class="alert alert-danger" role="alert">原始密码错误</div>';
             }
         }

         $this->render('add',array(

         ));
     }

     /**
      * 部门列表
      */
     public function actionList($page = 1){

         $count = IMDepartment::model()->count();
         $pager = new CPagination($count);
         $pager->pageSize = Yii::app()->params['perPage'];
         if(empty($page))
             $pager->currentPage = 1;

         $list = IMDepartment::model()->findAll(array(
             'order' => 'id DESC',
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
      * 删除部门
      */
     public function actionDel($id){

         if(empty($id))
             return;


         $count = IMDepartment::model()->deleteByPk($id);
         if($count > 0){
             echo '<div class="alert alert-success" role="alert">添加成功</div>';
         }else{
             echo '<div class="alert alert-success" role="alert">添加成功</div>';
         }

     }

     /**
      * 修改部门
      */
     public function actionEdit($id){

         if(empty($id))
             return;
         $depart = IMDepartment::model()->findByPk($id);

         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');

             $depart->attributes = $data;

             $time = time();
             $depart->updated = $time;
             if($depart->update()){
                 echo '<div class="alert alert-success" role="alert">修改成功</div>';
                 $departs = IMDepartment::model()->findAll(array(
                     'condition' => 'status = 1',
                 ));

                 foreach($departs as $k => $v){
                     $cache[$k]['id'] = $v->id;
                     $cache[$k]['departId'] = $v->departId;
                     $cache[$k]['title'] = $v->title;
                     $cache[$k]['desc'] = $v->desc;
                     $cache[$k]['pid'] = $v->pid;
                     $cache[$k]['leader'] = $v->leader;
                 }
                 if(!empty($cache))
                     Yii::app()->cache->set('cache_depart',$cache);
             }else{
                 echo '<div class="alert alert-danger" role="alert">修改失败</div>';
             }
         }
         $users = Yii::app()->cache->get('cache_user');
         $this->render('add',array(
             'data' => $depart,
             'users' => $users,
         ));
     }

 }