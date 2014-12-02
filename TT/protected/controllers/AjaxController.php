<?php
/**
 * Project: yiiim
 * File: AjaxController.php
 * User: 明心
 * Date: 14-8-10
 * Time: 下午11:07
 * Desc: 
 */
class AjaxController extends Controller{

    public function actionLogin(){

        $result['status'] = false;
        $result['msg'] = '登录失败';
        $result['url'] = '/user/add';
        $adminInfo = Yii::app()->cache->get('cache_admininfo');
        if(!$adminInfo){
            $this->getAdminCache();
        }
        $admin['uname'] = $adminInfo[0]['uname'];
        $admin['pwd'] = $adminInfo[0]['pwd'];
        $uname = trim(Yii::app()->request->getPost('uname'));
        $pwd = md5(trim(Yii::app()->request->getPost('pwd')));
        if($admin['uname'] == $uname && $admin['pwd'] == $pwd){
            $result['status'] = true;
            $result['msg'] = '登录成功';
            Yii::app()->session['uname'] = $admin['uname'];
        }
        echo json_encode($result);
    }
}
