# alconService

> 概述：  
> 利用 Phalcon 和 Yar 在几分钟之内创建项目Service层, 应用层方便取得模型数据.  

> 依赖：Phalcon，Yar  

> 部署：  
> 1）./deploy  
> 2）vim ./config/config.ini  
> 3）注意依赖Service的应用，调用地址是否正确.  

> Nginx配置示例：

````
server {
    listen 8090;
    root /home/www/alconService/public;

    location / { 
        index index.html index.htm index.php;
        try_files $uri $uri/ /index.php?_url=$uri&$args;
    }   

    location ~ \.php$ {
        fastcgi_pass   127.0.0.1:9000;
        fastcgi_index  index.php;
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
    access_log logs/alconservice.access.log;
}
````

> Phalcon客户端调用：
> `Usage Example: echo \Labor\Serv\Bbs\Question::get('http://127.0.0.1:8090/bbs/question')->ask('test');`  

