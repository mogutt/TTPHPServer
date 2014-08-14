<?php
/**
 * Project: yiiim
 * File: DepartController.php
 * User: 明心
 * Date: 14-8-7
 * Time: 下午2:17
 * Desc: 
 */

 class DepartController extends Controller{

     /**
      * 组织架构添加
      */
     public function actionAdd(){

         if(Yii::app()->request->isPostRequest){

             $depart = new IMDepartment();
             $data = Yii::app()->request->getPost('data');
             $depart->attributes = $data;
             $time = time();
             $depart->created = $time;
             $depart->updated = $depart->created;

             if($depart->save())
             {
                 echo '<div class="alert alert-success" role="alert">添加成功</div>';
                 $this->getDepartCache();
             }else{
                 echo $depart->getErrors();
                 echo '<div class="alert alert-danger" role="alert">添加失败</div>';
             }
         }
         $users = Yii::app()->cache->get('cache_user');
         if(empty($users)){
            $users = $this->getUserCache();
         }

         $this->render('add',array(
             'users' => $users,
         ));
     }

     /**
      * 部门列表
      */
     public function actionList($page = 1){

         $count = IMDepartment::model()->count(array(
             'condition' => 'status = 0',
         ));
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

         $depart = IMDepartment::model()->findByPk($id);
         $depart->status = 0;

         if($depart->save()){
             echo '<div class="alert alert-success" role="alert">删除成功</div>';
         }else{
             echo '<div class="alert alert-danger" role="alert">删除失败</div>';
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
                 $this->getDepartCache();
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