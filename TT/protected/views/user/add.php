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
<link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
<link rel="stylesheet" href="/css/bootstrap-3.0.3.min.css" type="text/css"/>
<style>
    .uploadclass{
        width:80px;
    }
    span .import{
        color:red;
    }
</style>
<form role="form" method="post" enctype="multipart/form-data">
    <div class="form-group col-xs-4">
        <label for="exampleInputEmail1">用户标题<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入用户标题" name="data[title]" value="<?php $str = !empty($data->title) ? $data->title : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">用户名<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入用户名" name="data[uname]" value="<?php $str = !empty($data->uname) ? $data->uname : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">花名<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入花名" name="data[nickName]" value="<?php $str = !empty($data->nickName) ? $data->nickName : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">密码<span>(*)</span></label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="输入密码" name="data[pwd]" value="<?php $str = !empty($data->pwd) ? $data->pwd : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputFile">头像</label>
        <input type="hidden" id="exampleInputFile" name="data[avatar]" value="<?php $str = !empty($data->avatar) ? $data->avatar : ''; echo $str; ?>">
        <input type="file" id="exampleInputFile" name="data[avatar]">
        <?php
            if(!empty($data->avatar)){
        ?>
            <img src="<?php echo $this->showImg($data->avatar);?>" class="uploadclass">
        <?php
            }
        ?>
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">部门<span>(*)</span></label>
        <select id="depart"  name ="data[departId]">
            <?php
            if(!empty($departs)){
                foreach($departs as $k => $v){
            ?>
                    <option value="<?php echo $v['id'];?>" ><?php echo $v['title'];?></option>
            <?php
                }
            }
            ?>
        </select>
    </div>

    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">手机号码<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入手机号码" name="data[telphone]" value="<?php $str = !empty($data->telphone) ? $data->telphone : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">邮箱<span>(*)</span></label>
        <input type="mail" class="form-control" id="exampleInputPassword1" placeholder="输入邮箱" name="data[mail]" value="<?php $str = !empty($data->mail) ? $data->mail : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">性别<span>(*)</span></label>
        <div class="radio">
        <label>
            <input type="radio" name="data[sex]" value="1"  <?php if(isset($data->sex) && $data->sex == 1){echo 'checked';}elseif(empty($data->sex)){echo 'checked';}?>>男
        </label>&nbsp;
        <label>
            <input type="radio" name="data[sex]" value="0" <?php if(isset($data->sex) && $data->sex == 0){echo 'checked';} ?>>女
        </label>
        </div>
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">地址<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入地址" name="data[position]" value="<?php $str = !empty($data->position) ? $data->position : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">工号<span>(*)</span></label>
        <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入工号" name="data[jobNumber]" value="<?php $str = !empty($data->jobNumber) ? $data->jobNumber : ''; echo $str; ?>">
    </div>
    <div class="form-group col-xs-4">
        <label for="exampleInputPassword1">状态<span>(*)</span></label>
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
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#depart').multiselect();
    })
</script>