<?php

class IMGroupRelation extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'tbl_user':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $email
     * @var string $profile
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return "IMGroupRelation";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('groupId, userId,title ,groupType,status, created, updated ', 'required'),
            array('id, groupId, userId,title,groupType,status, created, updated ', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(

        );
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'groupid' => 'GroupId',
            'groupname' => 'GroupName',
            'userid' => 'UserId',
            'title' => 'Title',
            'grouptype' => 'GroupType',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        );
    }
}