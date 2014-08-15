<!DOCTYPE html>
<!-- saved from url=(0052)http://preview.bootstrapguru.com/delighted/lock.html -->
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
            <input type="text" class="form-control " name="uname" placeholder="输入账号">
            <span class="input-group-addon"><i class="fa fa-user"></i></span>
        </div>

        
    </div>
    <div class="form-group pull-right input-password">
        <div class="input-group">
            <span class="input-group-addon">密码</span>
            <input type="password" class="form-control " placeholder="输入密码" id="pwd">
        </div>
    </div>
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
                            window.location.href = data.url;
                        },500);
                    }else{
                        $('.alert').remove();
                        var prependHtml = '<div class="alert alert-danger" role="alert">登录失败,用户名或者密码不正确!</div>';
                        $("body").prepend(prependHtml);
                    }
                }
            });
        });
    });
</script>

</body></html>