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
* 请在nginx的配置文件中增加如下配置:
* if (!-e $request_filename) {
*     rewrite ^/(.*)$ /index.php/$1 last;
*     break;
* }
# 数据库配置
* 在application/config/database.php里面修改
