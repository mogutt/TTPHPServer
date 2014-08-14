<?php
/**
 * Project: yiiim
 * File: DepartController.php
 * User: 明心
 * Date: 14-8-7
 * Time: 下午2:17
 * Desc: 
 */

 class GroupController extends Controller{

     /**
      * 群组管理
      */
     public function actionAdd(){

         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');
             //事务处理
             $transaction = Yii::app ()->db->beginTransaction ();
            try{
             $group = new IMGroup();
             $group->attributes = $data;
             $group->avatar = $this->upload('data[avatar]');
             if(empty($group->avatar)){
                 $group->avatar = Yii::app()->params['avatar'];
             }
             $seluserid = array();
             $countsel = 0;
             if(!empty($data['seluserid'])){
                $seluserid = explode(',',$data['seluserid']);
                $countsel = count($seluserid);

             }
             $group->memberCnt = $countsel;
             $group->created = time();
             $group->updated = $group->created;


                if($group->save()){
                 if(!empty($seluserid)){
                     $i = 1;
                     IMGroupRelation::model()->deleteAll(array(
                        'condition' => 'groupId = '.$group->groupId,
                     ));
                     foreach($seluserid as $v){
                         if(!empty($v)){
                             $groupRelation = new IMGroupRelation();
                             $groupRelation->groupId = $group->groupId;
                             $groupRelation->userId = $v;
                             $groupRelation->groupType = $group->groupType;
                             $groupRelation->status = 0;
                             $groupRelation->created = $group->created;
                             if($groupRelation->save()){
                                $i++;
                             }
                         }
                     }
                 }
                 if(isset($i) && $countsel == $i){
                     $this->sendGroupInterface($group->groupId,$seluserid,$group->groupName,$group->avatar);
                     echo '<div class="alert alert-success" role="alert">添加成功</div>';
                 }else{
                     echo '<div class="alert alert-danger" role="alert">添加失败</div>';
                 }

             }else{
                 echo '<div class="alert alert-danger" role="alert">添加失败</div>';
             }
                $transaction->commit ();
             }catch(Exception $e){
                $transaction->rollback ();
             }
         }
         $users = Yii::app()->cache->get('cache_user');
         $this->render('add',array(
            'users' => $users,
         ));
     }

     /**
      * 群组列表
      */
     public function actionList($page = 1){

         $count = IMGroup::model()->count(array(
            'condition' => 'status = 0',
         ));
         $pager = new CPagination($count);
         $pager->pageSize = Yii::app()->params['perPage'];
         if(empty($page))
             $pager->currentPage = 1;

         $list = IMGroup::model()->findAll(array(
             'condition' => 'status = 0',
             'order' => 'groupId DESC',
             'offset' => $pager->getCurrentPage()*$pager->getPageSize(),
             'limit' => $pager->pageSize,
         ));
         $data = array();
         if(!empty($list)){
             foreach($list as $v){
                 $data[] = $v->attributes;
             }
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

         $group = IMGroup::model()->findByPk($id);
         $group->status = 0;

         if($group->save()){
             echo '<div class="alert alert-success" role="alert">删除成功</div>';
         }else{
             echo '<div class="alert alert-success" role="alert">删除失败</div>';
         }

     }

     /**
      * 修改部门
      */
     public function actionEdit($id){

         if(empty($id))
             return;
         $group = IMGroup::model()->findByPk($id);
         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');
             try{
                 $group->attributes = $data;
                 if(!empty($data['avatar'])){
                     $group->avatar = $this->upload('data[avatar]');
                 }else{
                     $group->avatar = '/avatar/avatar_group_default.jpg';
                 }
                 $countsel = 0;
                 if(!empty($data['seluserid'])){
                     $seluserid = explode(',',$data['seluserid']);
                     $countsel = count($seluserid);
                 }
                 $group->memberCnt = $countsel;
                 $group->updated = time();
                 if($group->save()){
                     if(!empty($seluserid)){
                         $i = 1;
                         $oldGroupRelation = IMGroupRelation::model()->deleteAll(array(
                             'condition' => 'groupId = '.$group->groupId,
                         ));

                         foreach($seluserid as $k => $v){
                             if(!empty($v)){
                                 $groupRelation = new IMGroupRelation();
                                 $groupRelation->groupId = $group->groupId;
                                 $groupRelation->userId = $v;
                                 $groupRelation->groupType = $group->groupType;
                                 $groupRelation->status = 0;
                                 $groupRelation->created = $group->created;
                                 if($groupRelation->save()){
                                     $i++;
                                 }
                             }
                         }

                     }

                     if($countsel == $i){
                         echo '<div class="alert alert-success" role="alert">添加成功</div>';
                     }

                 }else{
                     echo '<div class="alert alert-danger" role="alert">添加失败</div>';
                 }

             }catch(Exception $e){

             }
         }
         $groupSelUserId = IMGroupRelation::model()->findAll(array(
             'condition' => 'groupId = '.$id,
         ));
         $users = Yii::app()->cache->get('cache_user');
         $this->render('add',array(
             'data' => $group,
             'users' => $users,
             'selUser' => $groupSelUserId,
         ));
     }

 }
