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
<link rel="stylesheet" href="/css/bootstrap-multiselect.css" type="text/css"/>
<link rel="stylesheet" href="/css/bootstrap-3.0.3.min.css" type="text/css"/>
<form role="form" method="post" enctype="multipart/form-data" class="formclass form-horizontal">
    <div class="form-group">
        <label for="exampleInputEmail1" class="col-sm-2 control-label">部门名称</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="输入部门名称" name="data[title]" value="<?php $str = !empty($data->title) ? $data->title : ''; echo $str; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">所属部门</label>
        <div class="col-sm-4">
            <select name="data[pid]">
                <option value="0" class="form-control" class="col-sm-2 control-label">父级部门</option>
                <?php
                    if(isset($departs) && !empty($departs)){
                        foreach($departs as $v){
                            if($v['pid'] == 0){
                ?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['title']?></option>
                <?php
                            }
                        }
                    }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">部门描述</label>
        <div class="col-sm-4">
            <textarea class="form-control" rows="3" name="data[desc]"><?php $str = !empty($data->desc) ? $data->desc : ''; echo $str; ?></textarea>
        </div>    
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">部门leader</label>
        <div class="col-sm-4">
        	<select id="test-build-filter-select"  name ="data[leader]">
        	<?php 
        		if(!empty($users)){
        			foreach($users as $k => $v){
        	?>			
                               <option value="<?php echo $v['userId'];?>" <?php if(isset($data->leader) && $v['userId']== $data->leader){echo 'selected="selected"';}?>><?php echo $v['uname'];?></option>
        			<?php
        					}
        				}
        			?>
            </select>
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
            return '未选择';
        }
    }($('#test-build-filter-select'), $('#test-build-filter-tr'));
});
</script>
