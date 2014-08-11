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
        <label for="exampleInputEmail1">部门名称</label>
        <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入部门名称" name="data[title]" value="<?php $str = !empty($data->title) ? $data->title : ''; echo $str; ?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">所属部门</label>

        <select name="data[pid]">
            <option value="0" class="form-control">初始部门</option>

        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">部门描述</label>
        <textarea class="form-control" rows="3" name="data[desc]"><?php $str = !empty($data->desc) ? $data->desc : ''; echo $str; ?></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">部门leader</label>
        <select class="select">
            <?php
                foreach($users as $v){
                    echo '<option value="'.$v['id'].'">'.$v['uname'].'</option>';
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1">状态</label>
        <div class="radio">
            <label>
                <input type="radio" name="data[status]" value="1"  <?php if(isset($data->status) && $data->status == 1){echo 'checked';}elseif(empty($data->status)){echo 'checked';}?>>启用
            </label>&nbsp;
            <label>
                <input type="radio" name="data[status]" value="0" <?php if(isset($data->status) && $data->status == 0){echo 'checked';} ?>>禁用
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