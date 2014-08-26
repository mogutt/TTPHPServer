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
    <a href="/group/add/" class="btn btn-default btn-add">添加</a>
<h3>群组列表页面</h3>
<table class="table table-bordered">
    <thead>
    <tr>
        <td>GroupId</td>
        <td>群名称</td>
        <td>群头像</td>
        <td>群描述</td>
        <td>创建者ID</td>
        <td>群组类型</td>
        <td>成员人数</td>
        <td>创建时间</td>
        <td>状态</td>
        <td>操作</td>
    </tr>
    </thead>
<?php
    foreach($list as $k => $v){
?>
    <tr>
        <td><?php echo CHtml::encode($v['groupId']);?></td>
        <td><?php echo CHtml::encode($v['groupName']);?></td>
        <td><img src="<?php echo $this->showImg($v['avatar']);?>" style="width:100px;max-height: 200px;"></td>
        <td><?php echo CHtml::encode($v['adesc']);?></td>
        <td><?php echo CHtml::encode($this->getUserInfo($v['createUserId']));?></td>
        <td><?php echo CHtml::encode($this->groupType($v['groupType']));?></td>
        <td><?php echo CHtml::encode($v['memberCnt']);?></td>
        <td><?php echo CHtml::encode(date('Y-m-d',$v['created']));?></td>
        <td><?php echo CHtml::encode($this->showStatus($v['status']));?></td>
        <td>
            <a href="/group/edit/<?php echo $v['groupId'];?>"><button type="button" class="btn btn-info">修改</button></a>
            <!--a href="/group/del/<?php echo $v['groupId'];?>"><button type="button" class="btn btn-danger">删除</button></a-->

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