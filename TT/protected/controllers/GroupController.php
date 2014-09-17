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
             $file = $this->image();
             //事务处理
             $transaction = Yii::app ()->db->beginTransaction ();
            try{
             $group = new IMGroup();
             $group->attributes = $data;
             if($_FILES['data']['tmp_name']['mod_avatar']){
                $group->avatar = $this->_upload($file);
                 // $group->avatar = $this->upload('data[mod_avatar]');
             }else{
                 // $group->avatar = '';
             }
	     $selUserId = array();
	     if(!empty($data['selUserId']))
             	$selUserId = $data['selUserId'];
             $countSel = 0;
             if(!empty($selUserId)){
                $countSel = count($data['selUserId']);
             }
             $group->memberCnt = $countSel;
             $group->created = time();
             $group->updated = $group->created;

                if($group->save()){
                 if(!empty($selUserId)){
                     $i = 0;
                     IMGroupRelation::model()->deleteAll(array(
                        'condition' => 'groupId = '.$group->groupId,
                     ));
                     foreach($selUserId as $v){
                         if(!empty($v)){
                             $groupRelation = new IMGroupRelation();
                             $groupRelation->groupId = $group->groupId;
                             $groupRelation->userId = $v;
                             $groupRelation->groupType = $group->groupType;
                             $groupRelation->status = 0;
                             $groupRelation->created = $group->created;
                             if($groupRelation->save()){
                                ++$i;
                             }
                         }
                     }
                 }
                 if(isset($i) && $countSel == $i){
                     $this->sendGroupInterface($group->groupId,$selUserId,$group->groupName,$group->avatar);
                     $this->showAlert('success','群组创建成功');
                 }else{
                     $this->showAlert('fail','群组创建失败');
                 }

             }else{
                $this->showAlert('fail','群组创建失败');
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

         $result['status'] = false;
         if(empty($id))
             return;

         $group = IMGroup::model()->findByPk($id);
         $group->status = 1;

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
         $transaction = Yii::app ()->db->beginTransaction ();
         try{
             if(Yii::app()->request->isPostRequest){
                 $data = Yii::app()->request->getPost('data');
                 $file = $this->image();
                 // var_dump($data);
                 // var_dump($group);
                 $group->attributes = $data;
                 // var_dump($_FILES['data']);
                 if($_FILES['data']['tmp_name']['mod_avatar']){
                    $group->avatar = $this->_upload($file);
                     // $group->avatar = $this->upload('data[mod_avatar]');
                 }else{
                     // $group->avatar = '';
                 }
                 // var_dump($data);
                 // if(!empty($data['avatar']) && $group->avatar != $data['avatar']){
                 //     $group->avatar = $this->upload('data[avatar]');
                 // }elseif(empty($data['avatar'])){
                 //     $group->avatar = Yii::app()->params['avatar'];
                 // }
                 $selUserId = $data['selUserId'];
                 $countSel = 0;
                 if(!empty($selUserId)){
                    $countSel = count($data['selUserId']);
                 }
                 $group->memberCnt = $countSel;
                 $group->updated = time();
                 if($group->save()){
                     if(!empty($selUserId)){
                         $i = 0;
                         $oldGroupRelation = IMGroupRelation::model()->deleteAll(array(
                             'condition' => 'groupId = '.$group->groupId,
                         ));
			//把relation表中涉及的用户全部干掉,在新增
			//千帆.这一块的代码是个坑.你抽空优化下吧.@明心
			 if(!empty($selUserId)){
                         foreach($selUserId as $k => $v){
                             if(!empty($v)){
                                 $groupRelation = new IMGroupRelation();
                                 $groupRelation->groupId = $group->groupId;
                                 $groupRelation->userId = $v;
                                 $groupRelation->groupType = $group->groupType;
                                 $groupRelation->status = 0;
                                 $groupRelation->created = $group->created;
                                 if($groupRelation->save()){
                                     $i++;
                                 }else{
                                    var_dump($groupRelation->getErrors());
                                 }
                             }
                         }
			}
                     }
                     if(isset($i) && $countSel == $i){
                         $this->updateGroupInterface($group->groupId,$selUserId);
                         $this->showAlert('success','群组创建成功');
                     }else{
                         $this->showAlert('fail','群组创建失败');
                     }
                 }else{
                     $this->showAlert('fail','群组创建失败');
                     var_dump($group->getErrors());
                 }
             }
            $transaction->commit ();
         }catch(Exception $e){
             $transaction->rollback();
         }
         $groupSelUserId = IMGroupRelation::model()->findAll(array(
             'condition' => 'groupId = '.$id,
         ));
         $users = Yii::app()->cache->get('cache_user');
         if(!empty($groupSelUserId)){
            $selUsers = array();
            foreach($groupSelUserId as $v){
                $selUsers[] = $v->userId;
            }
         }
         $this->render('add',array(
             'data' => $group,
             'users' => $users,
	     'selUsers' => $selUsers,
         ));
     }
 }
