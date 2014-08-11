<?php
/**
 * Project: yiiim
 * File: MyPager.php
 * User: 明心
 * Date: 14-8-6
 * Time: 下午3:52
 * Desc: 
 */
class MyPager extends CLinkPager{

    public function init()
    {
        if($this->nextPageLabel===null)
            $this->nextPageLabel=Yii::t('yii','Next &gt;');
        if($this->prevPageLabel===null)
            $this->prevPageLabel=Yii::t('yii','&lt; Previous');
        if($this->firstPageLabel===null)
            $this->firstPageLabel=Yii::t('yii','&lt;&lt; First');
        if($this->lastPageLabel===null)
            $this->lastPageLabel=Yii::t('yii','Last &gt;&gt;');
        if($this->header===null)
            $this->header=Yii::t('yii','Go to page: ');

        if(!isset($this->htmlOptions['class']))
            $this->htmlOptions['class']='pagination';
    }

    public function run()
    {
        $this->registerClientScript();
        $buttons=$this->createPageButtons();
        if(empty($buttons))
            return;
        echo $this->header;
        echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
        echo $this->footer;
    }

    protected function createPageButton($label,$page,$class,$hidden,$selected)
    {
        $result = '<li>';
        if($selected){
            $result = '<li class="active">';
        }
        return $result.CHtml::link($label,$this->createPageUrl($page)).'</li>';
    }

}