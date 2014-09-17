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
                 if($config->save()){
                     echo '<div class="alert alert-success" role="alert">添加成功</div>';
                 }else{
                     echo '<div class="alert alert-danger" role="alert">添加成功</div>';
                 }

             }else{
                 $oldconfig->attributes = $data;
                 if($oldconfig->update()){
                     echo '<div class="alert alert-success" role="alert">修改成功</div>';
                 }else{
                     echo '<div class="alert alert-danger" role="alert">修改成功</div>';
                 }
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
                 echo '<div class="alert alert-danger" role="alert">修改失败</div>';
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