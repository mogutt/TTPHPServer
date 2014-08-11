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
<form role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">用户标题</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入用户标题" name="data[title]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">用户名</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入用户名" name="data[uname]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">花名</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入花名" name="data[nickName]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="输入密码" name="data[pwd]">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">头像</label>
        <input type="file" id="exampleInputFile" name="data[avatar]">

        <p class="help-block">Example block-level help text here.</p>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">部门</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入部门" name="data[departId]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">手机号码</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入手机号码" name="data[telphone]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">邮箱</label>
        <input type="mail" class="form-control" id="exampleInputPassword1" placeholder="输入邮箱" name="data[mail]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">性别</label>
        <div class="radio">
            <label>
                <input type="radio" name="data[sex]" value="1" checked>男
            </label>&nbsp;
            <label>
                <input type="radio" name="data[sex]" value="0">女
            </label>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">地址</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入地址" name="data[position]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">工号</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入工号" name="data[jobNumber]">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">状态</label>
        <div class="radio">
            <label>
                <input type="radio" name="data[status]" value="1" checked>启用
            </label>&nbsp;
            <label>
                <input type="radio" name="data[status]" value="0">禁用
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-default">添加</button>
</form>