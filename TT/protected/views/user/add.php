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
    .uploadclass{
        width:80px;
    }
</style>
<form role="form" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1">用户标题</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入用户标题" name="data[title]" value="<?php $str = !empty($data->title) ? $data->title : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">用户名</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入用户名" name="data[uname]" value="<?php $str = !empty($data->uname) ? $data->uname : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">花名</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入花名" name="data[nickName]" value="<?php $str = !empty($data->nickName) ? $data->nickName : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">密码</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="输入密码" name="data[pwd]" value="<?php $str = !empty($data->pwd) ? $data->pwd : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">头像</label>
        <input type="hidden" id="exampleInputFile" name="data[avatar]" value="<?php $str = !empty($data->avatar) ? $data->avatar : ''; echo $str; ?>">
        <input type="file" id="exampleInputFile" name="data[avatar]">
        <?php
            if(!empty($data->avatar)){
        ?>
            <img src="<?php echo $data->avatar;?>" class="uploadclass">
        <?php
            }
        ?>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">部门</label>
        <select class="select" name="data[departId]">
            <?php
            foreach($departs as $v){
                echo '<option value="'.$v['id'].'">'.$v['title'].'</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">手机号码</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入手机号码" name="data[telphone]" value="<?php $str = !empty($data->telphone) ? $data->telphone : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">邮箱</label>
        <input type="mail" class="form-control" id="exampleInputPassword1" placeholder="输入邮箱" name="data[mail]" value="<?php $str = !empty($data->mail) ? $data->mail : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">性别</label>
        <div class="radio">
        <label>
            <input type="radio" name="data[sex]" value="1"  <?php if(isset($data->sex) && $data->sex == 1){echo 'checked';}elseif(empty($data->sex)){echo 'checked';}?>>男
        </label>&nbsp;
        <label>
            <input type="radio" name="data[sex]" value="0" <?php if(isset($data->sex) && $data->sex == 0){echo 'checked';} ?>>女
        </label>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">地址</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入地址" name="data[position]" value="<?php $str = !empty($data->position) ? $data->position : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">工号</label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入工号" name="data[jobNumber]" value="<?php $str = !empty($data->jobNumber) ? $data->jobNumber : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">状态</label>
        <div class="radio">
            <label>
                <input type="radio" name="data[status]" value="0"  <?php if(isset($data->status) && $data->status == 0){echo 'checked';}elseif(!isset($data->status)){echo 'checked';}?>>启用
            </label>&nbsp;
            <label>
                <input type="radio" name="data[status]" value="1" <?php if(isset($data->status) && $data->status == 1){echo 'checked';} ?>>禁用
            </label>
        </div>
    </div>
    <button type="submit" class="btn btn-default">
        <?php
            if(Yii::app()->controller->action->id == 'edit')
                echo '修改';
            else
                echo '添加';
        ?>
    </button>
</form>
