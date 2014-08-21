<?php

// this contains the application parameters that can be maintained via GUI
return array(
	// this is displayed in the header section
	'title'=>'TT Open Source',
	// this is used in error pages
	'adminEmail'=>'mingxin@mogujie.com',
	// number of posts displayed per page
	'postsPerPage'=>10,
	// maximum number of comments that can be displayed in recent comments portlet
	'recentCommentCount'=>10,
	// maximum number of tags that can be displayed in tag cloud portlet
	'tagCloudCount'=>20,
	// whether post comments need to be approved before published
	'commentNeedApproval'=>true,
    //列表页面每页显示10条
    'perPage' => 10,
    
    // 'uploadPath' => '/media/psf/Home/Sites/im/TT/uploadImage/',
    'site' => 'www.tt.tt',
    //创建群组时跟server端通信,发送群组内容
    'sendGroupInfodomain' => 'http://122.225.68.125:9800/query/createNormalGroup',
    //更新群组时发送消息给server端
    'updateGroupInfodomain' => 'http://122.225.68.125:9800/query/changeMembers',
    //图片上传接口域名
    'uploadSite' => 'http://122.225.68.125:8001/',
    //默认头像地址
    'avatar' => Yii::app()->params['uploadPath'].'/avatar_default.jpg',
    //默认后台管理员用户名密码
    'defaultAdminUname' => 'admin',
    'defaultAdminPwd' => 'admin',


);
