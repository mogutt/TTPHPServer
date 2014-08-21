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
                 $this->showAlert('success','创建成功');
                 $this->getDepartCache();
             }else{
                 $this->showAlert('fail','创建失败,请添加完整信息');
             }
         }
         $users = Yii::app()->cache->get('cache_user');
         if(empty($users)){
            $users = $this->getUserCache();
         }
         $departs = Yii::app()->cache->get('cache_depart');
         $this->render('add',array(
             'users' => $users,
             'departs' => $departs,
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
            'condition' => 'status = 0',
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
                 $this->showAlert('success','修改成功');
                 $this->getDepartCache();
             }else{
                 $this->showAlert('fail','修改失败');
             }
         }
         $departs = Yii::app()->cache->get('cache_depart');
         $users = Yii::app()->cache->get('cache_user');
         $this->render('add',array(
             'data' => $depart,
             'users' => $users,
             'departs' => $departs,
         ));
     }

 }
