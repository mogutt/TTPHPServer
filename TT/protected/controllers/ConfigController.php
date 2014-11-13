<?php
/**
 * Project: yiiim
 * File: DepartController.php
 * User: 明心
 * Date: 14-8-7
 * Time: 下午2:17
 * Desc: 
 */

 class ConfigController extends Controller{

     /**
      * 组织架构添加
      */
     public function actionAdd(){

         $oldconfig = IMConfig::model()->find(array(
             'order' => 'id DESC',
             'limit' => 1,
         ));

         if(Yii::app()->request->isPostRequest){

             $data = Yii::app()->request->getPost('data');

             if(empty($oldconfig)){
                 $config = new IMConfig();
                 $config->attributes = $data;
                 $config->save();
				 $this->showAlert('success','添加成功');
             }else{
                 $oldconfig->attributes = $data;
                 $oldconfig->update();
				 $this->showAlert('success','添加成功');
             }
         }
         $this->render('add',array(
            'data' => $oldconfig,
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
			$this->showAlert('success','删除成功');
         }else{
			$this->showAlert('fail','删除失败');
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
				$this->showAlert('success','删除成功');
                 $departs = IMDepartment::model()->findAll(array(
                     'condition' => 'status = 0',
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
				$this->showAlert('fail','删除失败');
             }
         }
         $users = Yii::app()->cache->get('cache_user');
         $this->render('add',array(
             'data' => $depart,
             'users' => $users,
         ));
     }

    /**
     * 获取配置
     */
    public function actionJson(){
        $oldconfig = IMConfig::model()->find(array(
            'order' => 'id DESC',
            'limit' => 1,
        ));
        $data = $oldconfig->attributes;
        $res = array(
            'login' => $data['cname'],
            'file' => $data['value']
        );
        echo json_encode($res);
    }
    

 }
