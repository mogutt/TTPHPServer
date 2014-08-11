<?php
/**
 * 默认主页
 */
class SiteController extends Controller
{
	public $layout='column1';


    /**
     * 首页
     */
    public function actionIndex(){


        //$this->redirect('login');

	}

    /**
     * 登陆页面
     */
    public function actionLogin(){

        $this->render('login',array());

    }

    /**
     * 登出
     */
    public function actionLoginOut(){
        Yii::app()->session->clear();  //删除session变量
        Yii::app()->session->destroy(); //删除服务器的session信息
        $this->redirect('/login');
    }

    /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}


}
