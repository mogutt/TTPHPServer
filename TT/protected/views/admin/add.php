<?php
/**
 * Project: yiiim
 * File: add.php
 * User: 明心
 * Date: 14-8-4
 * Time: 下午5:11
 * Desc: 
 */

?>
<style>
 .formclass{
        width:600px;
  } 
</style>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入用户名" name="data[uname]" value="admin">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">原始密码</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="exampleInputPassword" placeholder="输入密码" name="data[oldpwd]" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">新密码</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="exampleInputPassword" placeholder="输入密码" name="data[newpwd1]" value="">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">确认新密码</label>
        <div class="col-sm-4">
            <input type="password" class="form-control" id="exampleInputPassword" placeholder="再次输入密码" name="data[newpwd2]" value="">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">
                <?php
                    if(Yii::app()->controller->action->id == 'add')
                      echo '修改';
                    else
                        echo '添加';
                ?>
            </button>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $(".top-nav li").removeClass("active");
            $(".li_config").addClass("active");
        })
    </script>
</form>
