<?php
/**
 * Project: yiiim
 * File: loginForm.php
 * User: 明心
 * Date: 14-8-5
 * Time: 上午11:28
 * Desc: 
 */

return array(
    'title'=>'Please provide your login credential',

    'elements'=>array(
        'uname'=>array(
            'type'=>'text',
            'maxlength'=>32,
        ),
        'pwd'=>array(
            'type'=>'password',
            'maxlength'=>32,
        ),
        'rme'=>array(
            'type'=>'checkbox',
        )
    ),

    'buttons'=>array(
        'login'=>array(
            'type'=>'submit',
            'label'=>'Login',
        ),
    ),
);
