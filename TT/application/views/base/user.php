<aside class="right-side">
    <section class="content-header">
        <h1>
            用户管理
            <small>欢迎来到TeamTalk</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">用户管理</li>
        </ol>
    </section>
    <section class="content">
        <button style="margin-bottom:10px;" class="btn btn-primary btn-sm add_user pull-right">新增</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>用户标题</th>
                    <th>用户名</th>
                    <th>头像</th>
                    <th>昵称</th>
                    <th>所属部门</th>
                    <th>性别</th>
                    <th>地址</th>
                    <th>手机</th>
                    <th>邮箱</th>
                    <th>工号</th>
                    <th>编辑</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <ul class="pagination">
            <li class="prev_page">
                <a href="javascript:;">上一页</a>
            </li>
            <li class="show_page">
                <a href="javascript:;"></a>
            </li>
            <li class="next_page">
                <a href="javascript:;">下一页</a>
            </li>
        </ul>
    </section>
    <script>
        var User = {
            compiledTpl : null,
            compiledAddTpl : null,
            getUser : function(page){
                if(!page){
                    page = 0;
                }
                $.getJSON('/user/all', {
                    start : page
                }, function(data) {
                    User.tpl();
                    var _tpl = User.compiledTpl.render(data);
                    $("table").data('departs',data.departs);
                    $("tbody").html(_tpl);
                    if(data.page == 0){
                        $(".pagination .prev_page").addClass("disabled");   
                    }else{
                        $(".pagination .prev_page").removeClass("disabled").data('page',data.page-0-1);   
                    }
                    if(data.page == (data.count-1)){
                        $(".pagination .next_page").addClass("disabled");   
                    }else{
                        $(".pagination .next_page").removeClass("disabled").data('page',data.page-0+1);   
                    }
                    $(".pagination .show_page a").text('共'+data.count+'页');
                });
            },
            delUser : function(node){
                $.post('/user/del', {id: node.data('id')}, function(data) {
                    if($.trim(data) == 'success'){
                        node.fadeOut();
                    }
                });
            },
            editUser : function(){
                $.post('/user/edit', {
                    id:$(".btn-margin-edit").data('id'),
                    title: $(".title").val(),
                    uname: $(".uname").val(),
                    pwd: $(".pwd").val(),
                    avatar: $(".avatar").val(),
                    nickName: $(".nickName").val(),
                    departId: $(".departId").val(),
                    sex: $(".sex:checked").val(),
                    position: $(".position").val(),
                    mail: $(".mail").val(),
                    jobNumber: $(".jobNumber").val(),
                    telphone: $(".telphone").val()
                }, function(data) {
                    if($.trim(data) == 'success'){
                        $.fn.hideModal();
                        $(".add_user").before('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>编辑成功</div>')
                        setTimeout(function(){
                            $(".alert").remove();
                        },3000);
                        User.getUser();
                    }else{
                        $(".btn-margin-edit").text('编辑失败');
                    }
                });
            },
            addUser : function(){
                $.post('/user/add', {
                    title: $(".title").val(),
                    uname: $(".uname").val(),
                    pwd: $(".pwd").val(),
                    avatar: $(".avatar").val(),
                    nickName: $(".nickName").val(),
                    departId: $(".departId").val(),
                    sex: $(".sex:checked").val(),
                    position: $(".position").val(),
                    mail: $(".mail").val(),
                    jobNumber: $(".jobNumber").val(),
                    telphone: $(".telphone").val()
                }, function(data) {
                    if($.trim(data) == 'success'){
                        $.fn.hideModal();
                        $(".add_user").before('<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>添加成功</div>')
                        setTimeout(function(){
                            $(".alert").remove();
                        },3000);
                    }else{
                        $(".btn-margin").text('添加失败');
                    }
                });
            },
            editUserAlert : function(node){
                User.addTpl();
                $.fn.SimpleModal({
                    btn_ok: '编辑',
                    model: 'confirm',
                    callback: function(node){
                        User.editUser();
                    },
                    overlayClick: false,
                    width: 660,
                    title: '编辑用户',
                    contents: User.compiledAddTpl.render({'departs':$("table").data('departs')})
                }).showModal();
                $.post('/user/get', {
                    id:node.data('id')
                }, function(data) {
                    var data = JSON.parse(data);
                    $(".title").val(data.title);
                    $(".uname").val(data.uname);
                    $(".avatar").val(data.avatar);
                    if(data.avatar){
                        $(".avatar_show").attr("src",data.avatar_value).removeClass("hide");
                    }
                    $(".nickName").val(data.nickName);
                    $(".departId").val(data.departId);
                    $("#radio"+data.sex).attr("checked","checked");
                    $(".position").val(data.position);
                    $(".mail").val(data.mail);
                    $(".telphone").val(data.telphone);
                    $(".jobNumber").val(data.jobNumber);
                    $(".btn-margin").addClass("btn-margin-edit");
                    $(".btn-margin-edit").data('id',node.data('id'));
                });
                
            },
            addUserAlert : function(){
                User.addTpl();
                $.fn.SimpleModal({
                    btn_ok: '添加',
                    model: 'confirm',
                    callback: function(node){
                        User.addUser();
                    },
                    overlayClick: false,
                    width: 660,
                    title: '添加用户',
                    contents: User.compiledAddTpl.render({'departs':$("table").data('departs')})
                }).showModal();
            },
            addTpl : function(){
                var tpl =[
                    '<div class="add_user_div" role="form">',
                    '    <div class="clearfix">',
                    '        <input type="text" class="form-control input-sm title pull-left" placeholder="标题">',
                    '        <input type="text" style="margin-left:20px;" class="form-control input-sm uname pull-left" placeholder="用户名">',
                    '    </div>',
                    '    <div class="clearfix">',
                    '        <input type="password" class="form-control input-sm pwd" placeholder="密码">',
                    '        <input type="text" style="margin-left:20px;" class="form-control input-sm position" placeholder="地址">',
                    '    </div>',
                    '    <div class="clearfix">',
                    '        <input type="text" class="form-control input-sm nickName" placeholder="昵称">',
                    '        <select class="form-control departId input-sm" style="margin-left:20px;">',
                    '            {@each departs as depart}',
                    '                <option value="${depart.id}">${depart.title}</option>',
                    '            {@/each}',
                    '        </select>',
                    '    </div>',
                    '    <div class="clearfix">',
                    '        <div class="radio">',
                    '            <span class="text">性别:</span>',
                    '            <label>',
                    '                <input type="radio" id="radio1" class="sex" name="sex[]" value="1" checked="">男',
                    '            </label>',
                    '            <label>',
                    '                <input type="radio" id="radio0" class="sex" name="sex[]" value="0">女',
                    '            </label>',
                    '        </div>',
                    '        <input type="file" style="margin-left:20px;" id="file_avatar" class="file_avatar" name="file_avatar">',
                    '        <input type="hidden" id="avatar" class="avatar" name="avatar">',
                    '    </div>',
                    '    <div class="clearfix">',
                    '        <input type="text" class="form-control input-sm telphone" placeholder="手机">',
                    '        <input type="text" style="margin-left:20px;" class="form-control input-sm mail" placeholder="邮箱">',
                    '    </div>',
                    '    <div class="clearfix">',
                    '        <input type="text" class="form-control input-sm jobNumber" placeholder="工号">',
                    '        <img src="" style="height:30px;margin-left:20px;" class="avatar_show hide">',
                    '    </div>',
                    '</div>'
                ].join('\n');
                User.compiledAddTpl = juicer(tpl);
            },
            tpl : function(){
                var tpl=[
                    '{@each users as user}',
                    '   <tr data-id="${user.id}">',
                    '       <td>${user.id}</td>',
                    '       <td>${user.title}</td>',
                    '       <td>${user.uname}</td>',
                    '       <td>{@if user.avatar}<img style="height:30px;" src="${user.avatar_value}">{@/if}</td>',
                    '       <td>${user.nickName}</td>',
                    '       <td>${user.depart_value}</td>',
                    '       <td>${user.sex}</td>',
                    '       <td>${user.position}</td>',
                    '       <td>${user.telphone}</td>',
                    '       <td>${user.mail}</td>',
                    '       <td>${user.jobNumber}</td>',
                    '       <td><button style="margin-right:10px;" class="btn btn-warning btn-sm edit_user">编辑</button><button href="javascript:;" class="btn btn-danger btn-sm del_user">删除</button></td>',
                    '   </tr>',
                    '{@/each}'
                ].join('\n');
                User.compiledTpl = juicer(tpl);
            },
            upload : function(node){
                var file = $('.file_avatar')[0].files[0];
                var reader = new FileReader();
                reader.onload = function (rResult) {
                    var filename = file.name;
                    var options = {
                        type: 'POST',
                        url: '/user/upload?filename='+filename,
                        data: reader.result,
                        success:function(result){
                            var data = result;
                            if(data.status == 'success'){
                                $(".avatar_show").attr("src",data.real_path).removeClass("hide");
                                $(".avatar").val(data.file);
                            }
                        },
                        processData: false,
                        contentType: false,
                        dataType:"json"
                    };
                    $.ajax(options);
                };
                reader.readAsArrayBuffer(file);
            }
        }
        $(function(){
            User.getUser();

            $(".next_page,.prev_page").live("click",function(){
                User.getUser($(this).data('page'));
            })

            $(".del_user").live("click",function(){
                User.delUser($(this).parents('tr'));
            })

            $(".add_user").click(function(){
                User.addUserAlert();
            })

            $(".edit_user").live("click",function(){
                User.editUserAlert($(this).parents('tr'));
            })

            $(".file_avatar").live("change",function(){
                User.upload($(this));
            })
        })
    </script>
    <style>
        .add_user_div div{
            margin-top: 20px;
        }
        .radio span{
            display: inline-block;
            width: 50px;
        }
        .add_user_div div.radio{
            margin: 0;
        }
        .add_user_div input,.radio,.add_user_div select{
            width: 300px;
            float: left;
        }
        .radio input{
            width: 20px;
        }
    </style>
</aside>