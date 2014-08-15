<!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
    <title>Delighted</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <!-- Styles -->
    <link href="/css/lock.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/font-awesome.css" rel="stylesheet">
</head>
<body>
<div class="lock-holder">
    <div class="form-group pull-left input-username">
        <div class="input-group">
            <input type="text" class="form-control" id="uname" placeholder="输入账号">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>  
        </div>
    </div>
    <div class="form-group pull-right input-password">
        <div class="input-group">
            <input type="password" class="form-control " placeholder="输入密码" id="pwd">
	    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>  
        </div>
    </div>
</div>
<div class="avatar">
    <img src="/image/yaya.png" alt="蘑菇街TT开源小组" style="background-color: white;height: 110px;padding: 5px 0px 0px 0px;">
</div>
<div class="submit">
    <button type="button" class="btn btn-success btn-submit">Login</button>
</div>
<script src="/js/jquery.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/bootstrap-progressbar.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-submit').click(function(e){
            $.ajax({
                type: "POST",
                url: "/ajax/login",
                data: {uname:$("#uname").val(), pwd:$("#pwd").val()},
                dataType: "json",
                success: function(data){
                    if(data.status)
                    {
                        $('.input-username,dot-left').addClass('animated fadeOutRight')
                        $('.input-password,dot-right').addClass('animated fadeOutLeft')
                        $('.btn-submit').addClass('animated fadeOutUp')
                        setTimeout(function () {
                                $('.avatar').addClass('avatar-top');
                                $('.submit').html('<div class="progress"><div class="progress-bar progress-bar-success" aria-valuetransitiongoal="100"></div></div>');
                                $('.progress .progress-bar').progressbar();
                            },
                            500);
                        setTimeout(function () {
                                window.location.href = data.url;
                            },
                            1500);
                    }else{
                        $('.alert').remove();
                        var prependHtml = '<div class="alert alert-danger" role="alert">登录失败,用户名或者密码不正确!</div>';
                        $("body").prepend(prependHtml);
                    }
                }
            });
        });
	//绑定回车事件
	$(document).keydown(function(e){
		if(e.keyCode == 13){
			$('.btn-submit').click();
		}
	});

    });
</script>
</body></html>
