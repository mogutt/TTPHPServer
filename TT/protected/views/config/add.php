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
<form class="form-horizontal" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="exampleInputEmail1" class="col-sm-2 control-label">Login Server IP</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="data[cname]" value="<?php $str = !empty($data->cname) ? $data->cname : ''; echo $str; ?>">
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1" class="col-sm-2 control-label">Config Server IP</label>
        <div class="col-sm-4">
            <input type="text" class="form-control" id="exampleInputPassword" placeholder="" name="data[value]" value="<?php $str = !empty($data->value) ? $data->value : ''; echo $str; ?>">
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
