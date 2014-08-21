<?php
/**
 * Project: yiiim
 * File: list.php
 * User: 明心
 * Date: 14-8-5
 * Time: 下午4:04
 * Desc: 
 */
?>
<html>

<body>
    <a href="/depart/add/" class="btn btn-default btn-sm btn-add">添加</a>
<h3>部门列表页面</h3>
<table class="table table-bordered">
    <thead>
    <tr>
        <td>ID</td>
        <td>部门名称</td>
        <td>部门描述</td>
        <td>上级部门</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    </thead>
<?php
    foreach($list as $k => $v){
?>
    <tr>
        <td><?php echo CHtml::encode($v['id']);?></td>
        <td><?php echo CHtml::encode($v['title']);?></td>
        <td><?php echo CHtml::encode($v['desc']);?></td>
        <td><?php echo CHtml::encode($this->getDepartLevel($v['pid']));?></td>
        <td><?php echo CHtml::encode($this->showStatus($v['status']));?></td>
        <td>
            <a href="/depart/edit/<?php echo $v['id'];?>"><button type="button" class="btn btn-info">修改</button></a>
        </td>
    </tr>
<?php
    }
?>
<?php
    $this->widget('MyPager',array(
        'header'=>'',
        'firstPageLabel' => '首页',
        'lastPageLabel' => '末页',
        'prevPageLabel' => '上一页',
        'nextPageLabel' => '下一页',
        'pages' => $pager,
        'maxButtonCount'=>8
    ));
?>
</table>
<style>
    .pagination{
        width: 100%;
    }
    #content{
        position: relative;
    }
    .btn-add{
        position: absolute;
        right: 0px;
        top: 0px;
    }
</style>
<script type="text/javascript">
    $(function(){
        $(".top-nav li").removeClass("active");
        $(".li_manage").addClass("active");
    })
</script>
</body>
</html>