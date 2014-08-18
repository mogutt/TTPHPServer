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
<form role="form" method="post" enctype="multipart/form-data" class="formclass">
    <div class="form-group">
        <label for="exampleInputEmail1">Login Server IP</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="data[cname]" value="<?php $str = !empty($data->cname) ? $data->cname : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Config Server IP</label>
        <input type="text" class="form-control" id="exampleInputPassword" placeholder="" name="data[value]" value="<?php $str = !empty($data->value) ? $data->value : ''; echo $str; ?>">
    </div>
    <button type="submit" class="btn btn-default">
        <?php
            if(Yii::app()->controller->action->id == 'add')
                echo '修改';
            else
                echo '添加';
        ?>
    </button>
</form>
