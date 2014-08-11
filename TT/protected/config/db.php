<?php
/**
 * Project: yiiim
 * File: db.php
 * User: 明心
 * Date: 14-8-4
 * Time: 下午4:38
 * Desc: 
 */
return array(
    'class'=>'CDbConnection',
    'connectionString' => 'mysql:host=127.0.0.1;dbname=IM',
    'emulatePrepare' => true,
    'username' => 'root',
    'password' => '123456',
    'charset' => 'utf8',
);