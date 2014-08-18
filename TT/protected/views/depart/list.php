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
部门列表页面
<table class="table">
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
        <td><?php echo $v['id'];?></td>
        <td><?php echo $v['title'];?></td>
        <td><?php echo $v['desc'];?></td>
        <td><?php echo $this->getDepartLevel($v['pid']);?></td>
        <td><?php echo $this->showStatus($v['status']);?></td>
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
</body>
</html>