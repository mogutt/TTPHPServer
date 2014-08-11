<?php
	/**
	 * url规则文件
	 * 
	 */
	return array(
        'index' => 'site/login',
        'login' => 'site/login',
        'loginout' => 'site/loginout',

        /*----user----*/
        'user/list/<page:\d+>' => 'user/list',
        'user/del/<id:\d+>' => 'user/del',
        'user/add/<id:\d+>' => 'user/add',
        'user/edit/<id:\d+>' => 'user/edit',

        /*----department----*/
        'depart/add' => 'depart/add',
        'depart/del/<id:\d+>' => 'depart/del',
        'depart/list/<page:\d+>' => 'depart/list',
        'depart/edit/<id:\d+>' => 'depart/edit',

        /*----config----*/
        'config/add' => 'config/add',

        /*----group----*/
        'group/add' => 'group/add',
        'group/del/<id:\d+>' => 'group/del',
        'group/edit/<id:\d+>' => 'group/edit',

		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',	
	);