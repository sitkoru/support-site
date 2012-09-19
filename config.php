<?php

$version='2.14';

$config=array(

	//Системные пути
	'path'=>array(
		'www'=>				$_SERVER['DOCUMENT_ROOT'],
		'core'=>			'/home/www/tools/core_'.$version,
		'tmp'=>				$_SERVER['DOCUMENT_ROOT'].'/../tmp',

		//Публичные пути
		'images'=>	'/i',
		'files'=>	'/u',
		'styles'=>	'/c',
		'javascript'=>	'/j',
	),


  //Базы данных
	'db'=>array(
		'system'=>array(
			'lib_pack'=>false,
			'type'=>'mysql',
			'host'=>'localhost',
			'name'=>'sitko_help',
			'user'=>'sitko_help',
			'password'=>'DqAxv8hvlOsbS2GY'
		),
	),
	//Расширения к модели
	'extensions'=>array(
		'seo'=>'seo.php',
	),

	'openid'=>array(
		'sitko.ru'=>'admin',
	),
	
);

ini_set('include_path',implode(';',$config['path']));

?>