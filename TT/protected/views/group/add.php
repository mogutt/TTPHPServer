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
</style>
<form role="form" method="post" enctype="multipart/form-data" class="form-horizontal">
    <div class="form-group">
        <label for="exampleInputEmail1" class="col-sm-2 control-label">群名称</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入群名称" name="data[groupName]" value="<?php $str = !empty($data->groupName) ? $data->groupName : ''; echo $str; ?>" check-type="required" required-message="密码不能为空！">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputFile" class="col-sm-2 control-label">群头像</label>
        <div class="col-sm-4">
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
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">群描述</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="输入群描述" name="data[adesc]" value="<?php $str = !empty($data->adesc) ? $data->adesc : ''; echo $str; ?>">
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">群组类型</label>
        <div class="col-sm-4">
            <div class="radio">
                <label>
                    <input type="radio" name="data[groupType]" value="1"  <?php if(isset($data->groupType) && $data->groupType == 1){echo 'checked';}elseif(empty($data->groupType)){echo 'checked';}?>>固定
                </label>&nbsp;
                <label>
                    <input type="radio" name="data[groupType]" value="2" <?php if(isset($data->groupType) && $data->groupType == 2){echo 'checked';} ?>>临时
                </label>
            </div>
        </div> 
    </div>
    <div class="form-group">
<?php
?>
        <label for="exampleInputPassword1" class="col-sm-2 control-label">群组人员</label>
	<div>
        <div class="col-sm-4">
        	<select id="test-build-filter-select" multiple="multiple" name ="data[selUserId][]">
        			<?php 
        				if(!empty($users)){
        					foreach($users as $k => $v){
        			?>			
                               <option value="<?php echo $v['userId'];?>" <?php if(isset($selUsers) && in_array($v['userId'],$selUsers)){echo 'selected="selected"';}?>><?php echo $v['uname'];?></option>
        			<?php
        					}
        				}
        			?>
            </select>
        </div>
	</div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">状态</label>
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
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">
                <?php
                    if(Yii::app()->controller->action->id == 'edit')
                        echo '修改';
                    else
                        echo '添加';
                ?>
            </button>
        </div>
    </div>
</form>
<script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
<script type="text/javascript">
 $(document).ready(function() {
    var buildFilter = function(select, tr) {
        select.multiselect({
            enableFiltering: true
        });
        if ($('.multiselect-search', tr).length !== 1) {
            return 'No search input present.';
        }
    }($('#test-build-filter-select'), $('#test-build-filter-tr'));
});
</script>
