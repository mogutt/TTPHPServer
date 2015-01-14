# 简介
* TeamTalk是一套开源的企业办公即时通讯软件，作为整套系统的组成部分之一，TTWinClient为TeamTalk 的windows IM客户端，为用户提供收发文本消息，图片，表情等功能

# 当前支持的功能点
* 私人聊天
* 群组聊天
* 文件传输
* 多点登录
* 组织架构


# 修改说明
* 请将application/config/config.php 第18行
* $config['msfs_url'] = 'http://127.0.0.1:9600/'; 更改为自己的msfs服务器及port
# nginx 配置修改说明:
* 请在nginx的配置文件Server 段中增加如下配置:
* if (!-e $request_filename) {
*     rewrite ^/(.*)$ /index.php/$1 last;
*     break;
* }
# 数据库配置
* 在application/config/database.php里面修改

# 参考配置 请将xxx换成自己的配置
    log_format  teamtalk.com  '$remote_addr - $remote_user [$time_local] "$request" ' '$status $body_bytes_sent "$http_referer" ' '"$http_user_agent" $http_x_forwarded_for';
    server
    {
        listen       80;
        server_name xxxx.com;
        index index.html index.htm index.php default.html default.htm default.php;
        root  xxxx;

        location ~ \.php($|/) {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info ^(.+\.php)(.*)$;
            fastcgi_param   PATH_INFO $fastcgi_path_info;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }

        location ~ .*\.(gif|jpg|jpeg|png|bmp|swf)$
        {
            expires      30d;
        }

        location ~ .*\.(js|css)?$
        {
            expires      12h;
        }
        if (!-e $request_filename) {
            rewrite ^/(.*)$ /index.php/$1 last;
            break;
        }
    }
