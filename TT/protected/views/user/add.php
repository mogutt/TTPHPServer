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
<link rel="stylesheet" href="/css/jquery.Jcrop.min.css" type="text/css"/>
<script type="text/javascript" src="/js/jquery.Jcrop.min.js"></script>
<style>
    .uploadclass{
        width:80px;
    }
    .import{
        color:red;
    }
/*    .formclass{
        width:600px;
    }*/
</style>
<form role="form" method="post" enctype="multipart/form-data" class="formclass form-horizontal" id="signupForm">
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">用户标题<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="title" placeholder="输入用户标题" name="data[title]" value="<?php $str = !empty($data->title) ? $data->title : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">用户名<span class="import" >*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入用户名" name="data[uname]" value="<?php $str = !empty($data->uname) ? $data->uname : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">花名<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入花名" name="data[nickName]" value="<?php $str = !empty($data->nickName) ? $data->nickName : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">密码<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="输入密码" name="data[pwd]" value="<?php $str = !empty($data->pwd) ? $data->pwd : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group avatar-div">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <label for="exampleInputFile" class="col-sm-2 control-label">头像</label>
                <div class="col-sm-4">
                    <input type="hidden" id="exampleInputFile" name="data[avatar]" value="<?php $str = !empty($data->avatar) ? $data->avatar : ''; echo $str; ?>">
                    <input type="file" id="exampleInputFile" class="avatar" name="data[mod_avatar]">
                    <?php
                        if(!empty($data->avatar)){
                    ?>
                        <img src="<?php echo $this->showImg($data->avatar);?>" class="uploadclass">
                    <?php
                        }
                    ?>
                    <div class="avatar-preview">

                    </div>
                </div> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">部门<span class="import">*</span></label>
                <div class="col-sm-4">
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
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">手机号码<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入手机号码" name="data[telphone]" value="<?php $str = !empty($data->telphone) ? $data->telphone : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">邮箱<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="mail" class="form-control" id="exampleInputPassword1" placeholder="输入邮箱" name="data[mail]" value="<?php $str = !empty($data->mail) ? $data->mail : ''; echo $str; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">性别<span class="import">*</span></label>
                <div class="col-sm-4">
                    <div class="radio">
                    <label>
                        <input type="radio" name="data[sex]" value="1"  <?php if(isset($data->sex) && $data->sex == 1){echo 'checked';}elseif(empty($data->sex)){echo 'checked';}?>>男
                    </label>&nbsp;
                    <label>
                        <input type="radio" name="data[sex]" value="0" <?php if(isset($data->sex) && $data->sex == 0){echo 'checked';} ?>>女
                    </label>
                    </div>
                </div> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">地址<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入地址" name="data[position]" value="<?php $str = !empty($data->position) ? $data->position : ''; echo $str; ?>">
                </div> 
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">工号<span class="import">*</span></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入工号" name="data[jobNumber]" value="<?php $str = !empty($data->jobNumber) ? $data->jobNumber : ''; echo $str; ?>">
                </div>    
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="col-sm-2 control-label">状态<span class="import">*</span></label>
                <div class="col-sm-4">
                    <div class="radio">
                        <label>
                            <input type="radio" name="data[status]" value="0"  <?php if(isset($data->status) && $data->status == 0){echo 'checked';}elseif(!isset($data->status)){echo 'checked';}?>>启用
                        </label>&nbsp;
                        <label>
                            <input type="radio" name="data[status]" value="1" <?php if(isset($data->status) && $data->status == 1){echo 'checked';} ?>>禁用
                        </label>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">
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
    function updateCoords(c)
    {
        jQuery('#x').val(c.x);
        jQuery('#y').val(c.y);
        jQuery('#w').val(c.w);
        jQuery('#h').val(c.h);
    };

    $(document).ready(function() {
        $('#depart').multiselect();
        $('.avatar').change(function(){
            var file = this.files[0];
            var r = new FileReader();
            r.readAsDataURL(file);
            $(r).load(function(){
                $('.avatar-preview').html('<img class="preview-img" src="'+this.result+'"alt=""/>');
                $(".preview-img").Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    setSelect:   [ 100, 100, 50, 50 ]
                });
            });
        });
    })
</script>
<style type="text/css">
    .avatar-div{
        position: relative;
    }
    .avatar-preview{
        position: absolute;
        width: 200px;
        height: 200px;
        top: -200px;
        left: 200px;
    }
    .avatar-preview img{
        max-width: 200px;
        max-height: 200px;
    }
</style>