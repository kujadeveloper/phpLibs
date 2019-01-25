<?php
	date_default_timezone_set('Europe/Istanbul');
	setlocale(LC_TIME, 'Turkish');
	define("url","http://localhost/");
	define('md5Psw',"1");
  	define('version','v0.01');
  	define("author","TTI Technology");
  	define("now", date("Y-m-d H:i:s"));
	define("now_date", date("Y-m-d"));
	define("page", 15);
	define("pic_url",url."img/");
	define("pic_url_thumb",url."img/thumbnail/");
	define("pic_dizin","/var/www/html/img/");
	define("pic_dizin_thumb","/var/www/html/img/thumbnail/");
?>