<?php
if ($_SERVER['REQUEST_METHOD']=='POST'){

	//Command
	echo exec('cd /var/www/corp/sitko.ru/help.sitko.ru && git init && git stash && git pull origin master');
	
//	log
	$path = 'git-push.log';
	$f = fopen($path, 'a+');
	fwrite($f, date("Y-m-d H:i:s") . ': ' . implode("\n", $_POST) . "\n");
	fclose($f);
	chmod($path, 0775);
	
}

?>