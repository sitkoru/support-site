<?php

$_SERVER['DOCUMENT_ROOT'] = '/var/www/yamobi/Yamobi.ru/www';

$start_only = true;
require( '/var/www/yamobi/Yamobi.ru/config.php' );
require( $config['path']['core'] . '/core.php' );

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE ^ E_STRICT);
ini_set("display_errors", "on");

// Переиндексация рейтингов
/*
	require_once( $config['path']['www'] . '/../classes/field_usertype_rating.php' );
	field_usertype_rating::reindex();
*/

// Импортируем цены
if( date("Hi") < 15 ){
	require_once( $config['path']['www'] . '/../classes/ym_parser.php' );
	$ym_parser = new ym_parser();
	$ym_parser->import( false );
}

// Посчитаем производителей техники
$sql = 'select `gadgets_rec`.`company`, `company_rec`.`title`, CONCAT("/gadgets.all.html?company=", `company_rec`.`id`) as `url`, count(`gadgets_rec`.`id`) as `count` from `gadgets_rec` right join `company_rec` on `company_rec`.`id`=`gadgets_rec`.`company` where `company_rec`.`title`!="" group by `gadgets_rec`.`company` ORDER BY `company_rec`.`title` ASC';
$brands = model::execSql($sql, 'getall');
$n = array();foreach($brands as $b)if($b['count']>=model::$settings['gadgets_brands_min'])$n[] = $b;$brands = $n;
model::execSql('update `settings` set `value`="'.mysql_real_escape_string( serialize( $brands ) ).'" where `var`="gadgets_brands" limit 1', 'update');
pr('Индексация производителей гаджетов, найдено '.count($brands).' компаний.');

// Посчитаем категории техники
$sql = 'select `type` as `title`, count(`id`) as `count`, CONCAT("/gadgets.all.html?type=", `type`) as `url` from `gadgets_rec` group by `type` order by `count` desc';
$types = model::execSql($sql, 'getall');
model::execSql('update `settings` set `value`="'.mysql_real_escape_string( serialize( $types ) ).'" where `var`="gadgets_types" limit 1', 'update');
pr('Индексация категорий гаджетов, найдено '.count($types).' типов.');

// Количество комментариев в сюжетах
$sql = 'select `posts_rec`.`id`, count(`comments_rec`.`id`) as `count` from `posts_rec` inner join `comments_rec` on `comments_rec`.`record_id`=`posts_rec`.`id` and `comments_rec`.`module_sid`="posts" group by `posts_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `posts_rec` set `count_comments`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества комментариев в статьях');

// Количество лайков в сюжетах
$sql = 'select `id`, `like` from `posts_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['like'], model::$modules['posts']->structure['rec']['fields']['like']);
	model::execSql('update `posts_rec` set `count_likes`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества лайков в статьях');

// Количество комментариев в гаджетах
$sql = 'select `gadgets_rec`.`id`, count(`comments_rec`.`id`) as `count` from `gadgets_rec` inner join `comments_rec` on `comments_rec`.`record_id`=`gadgets_rec`.`id` and `comments_rec`.`module_sid`="gadgets" group by `gadgets_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `gadgets_rec` set `count_comments`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества комментариев в гаджетах');

// Количество лайков в гаджетах
$sql = 'select `id`, `like` from `gadgets_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['like'], model::$modules['gadgets']->structure['rec']['fields']['like']);
	model::execSql('update `gadgets_rec` set `count_likes`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества лайков в гаджетах');

// Количество пользователей в гаджетах
$sql = 'select `id`, `have` from `gadgets_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['have'], model::$modules['gadgets']->structure['rec']['fields']['have']);
	model::execSql('update `gadgets_rec` set `count_have`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества пользователей в гаджетах');

// Количество комментариев в сервисах
$sql = 'select `services_rec`.`id`, count(`comments_rec`.`id`) as `count` from `services_rec` inner join `comments_rec` on `comments_rec`.`record_id`=`services_rec`.`id` and `comments_rec`.`module_sid`="services" group by `services_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `services_rec` set `count_comments`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества комментариев в сервисах');

// Количество лайков в сервисах
$sql = 'select `id`, `like` from `services_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['like'], model::$modules['services']->structure['rec']['fields']['like']);
	model::execSql('update `services_rec` set `count_likes`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества лайков в сервисах');

// Количество пользователей в сервисах
$sql = 'select `id`, `have` from `services_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['have'], model::$modules['services']->structure['rec']['fields']['have']);
	model::execSql('update `services_rec` set `count_have`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества пользователей в сервисах');

// Количество комментариев в отзывах
$sql = 'select `reports_rec`.`id`, count(`comments_rec`.`id`) as `count` from `reports_rec` inner join `comments_rec` on `comments_rec`.`record_id`=`reports_rec`.`id` and `comments_rec`.`module_sid`="reports" group by `reports_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `reports_rec` set `count_comments`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества комментариев в отзывах');

// Количество лайков в отзывах
$sql = 'select `id`, `like` from `reports_rec`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$likes = model::$types['linkm']->getValueExplode($rec['like'], model::$modules['reports']->structure['rec']['fields']['like']);
	model::execSql('update `reports_rec` set `count_likes`='.count( $likes ).' where `id`='.$rec['id'].' limit 1','update');
}
pr('Подсчёт количества лайков в отзывах');

// Последний комментарий к статье
$sql = 'select `id` from `posts_rec` where `count_comments`>0';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec){
	$comm = model::execSql('select `id`,`date_public`,`text`, `author` from `comments_rec` where `module_sid`="posts" and `record_id`="'.$rec['id'].'" order by `date_public` desc', 'getrow');
	$author = model::execSql('select `title`, `img`, `url` from `users` where `id`="'.intval($comm['author']).'"', 'getrow');
	$author['img'] = unserialize( $author['img'] );	
	$comm['author'] = $author;
	model::execSql('update `posts_rec` set `comments`="'.mysql_real_escape_string( serialize( $comm ) ).'" where `id`='.$rec['id'].' limit 1','update');
}
pr('Последний комментарий внутри записи');

// Количество комментариев в сюжетах
$sql = 'select `gadgets_rec`.`id`, count(`reports_rec`.`id`) as `count` from `gadgets_rec` inner join `reports_rec` on `reports_rec`.`record_id`=`gadgets_rec`.`id` and `reports_rec`.`module_sid`="gadgets" group by `gadgets_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `gadgets_rec` set `count_reports`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества отзывов в гаджетах');

// Количество комментариев в сюжетах
$sql = 'select `apps_rec`.`id`, count(`reports_rec`.`id`) as `count` from `apps_rec` inner join `reports_rec` on `reports_rec`.`record_id`=`apps_rec`.`id` and `reports_rec`.`module_sid`="apps" group by `apps_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `apps_rec` set `count_reports`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества отзывов в приложениях');

// Количество комментариев в сюжетах
$sql = 'select `services_rec`.`id`, count(`reports_rec`.`id`) as `count` from `services_rec` inner join `reports_rec` on `reports_rec`.`record_id`=`services_rec`.`id` and `reports_rec`.`module_sid`="services" group by `services_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `services_rec` set `count_reports`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества отзывов в сервисах');

// Количество комментариев в сюжетах
$sql = 'select `gadgets_rec`.`id`, MIN(`price`) as `price`, count(`price_rec`.`id`) as `count` from `gadgets_rec` inner join `price_rec` on `price_rec`.`item_id`=`gadgets_rec`.`id` and `price_rec`.`item_module`="gadgets" group by `gadgets_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `gadgets_rec` set `count_prices`='.$rec['count'].', `min_price`="'.$rec['price'].'" where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт средней цены на гаджеты');


// Количество цен в компаниях
$mod = 'price';
$sql = 'select `company_rec`.`id`, count(`'.$mod.'_rec`.`id`) as `count` from `company_rec` inner join `'.$mod.'_rec` on `'.$mod.'_rec`.`company`=`company_rec`.`id` where `'.$mod.'_rec`.`shw`=1 group by `company_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `company_rec` set `count_'.$mod.'`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества цен в компаниях');

// Количество девайсов в компаниях
$mod = 'gadgets';
$sql = 'select `company_rec`.`id`, count(`'.$mod.'_rec`.`id`) as `count` from `company_rec` inner join `'.$mod.'_rec` on `'.$mod.'_rec`.`company`=`company_rec`.`id` where `'.$mod.'_rec`.`shw`=1 group by `company_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `company_rec` set `count_'.$mod.'`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества девайсов в компаниях');

// Количество тарифов в компаниях
$mod = 'tarifs';
$sql = 'select `company_rec`.`id`, count(`'.$mod.'_rec`.`id`) as `count` from `company_rec` inner join `'.$mod.'_rec` on `'.$mod.'_rec`.`company`=`company_rec`.`id` where `'.$mod.'_rec`.`shw`=1 group by `company_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `company_rec` set `count_'.$mod.'`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества тарифов в компаниях');

// Количество пресс-релизов в компаниях
$mod = 'press';
$sql = 'select `company_rec`.`id`, count(`'.$mod.'_rec`.`id`) as `count` from `company_rec` inner join `'.$mod.'_rec` on `'.$mod.'_rec`.`company`=`company_rec`.`id` where `'.$mod.'_rec`.`shw`=1 group by `company_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `company_rec` set `count_'.$mod.'`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Подсчёт количества пресс-релизов в компаниях');



// Переиндексация тегов
model::$types['tags']->reindexTegs();
pr('Переиндексация облака тегов');

// Порядковые номера пользователей, согласно рейтингу
$recs = model::execSql('select `id`, `rating`, `city` from `users` where `active`=1 order by `rating` desc, `date_public` asc', 'getall');
foreach( $recs as $k => $rec ){
	$city = model::execSql('select count( `id` ) as `count` from `users` where `rating`>'.$rec['rating'].' and `active`=1 and `city`="'.$rec['city'].'"', 'getrow');
	model::execSql('update `users` set `rating_position`='.intval( $k+1 ).', `rating_position_city`="'.intval( $city['count']+1 ).'" where `id`='.$rec['id'].' limit 1', 'update');
}
pr('Переиндексация позиций пользователей в рейтинге');

// Количество записей в группах
$groups = model::execSql('select * from `groups_rec`', 'getall');
foreach( $groups as $group ){
	$count_recs = 0;
	$count_borrowed = 0;
	$count_month = 0;
	
	// Размещённые в сети
	foreach( model::$modules as $module_sid=>$module )
		if( IsSet( $module->structure['rec']['fields']['group'] )){
			
			//Всего
			$sql = 'select count(`id`) as `count` from `'.$module->getCurrentTable().'` where `shw`=1 and `group`='.intval( $group['id'] );
			$t = model::execSql($sql, 'getrow');
			$count_recs += $t['count'];
			
			//За месяц
			$sql = 'select count(`id`) as `count` from `'.$module->getCurrentTable().'` where `date_public`>"'.date("Y-m-d", strtotime("-1 month")).'" and `shw`=1 and `group`='.intval( $group['id'] );
			$t = model::execSql($sql, 'getrow');
			$count_month += $t['count'];
		}
	// Заимствованные в сеть
	foreach( model::$modules as $module_sid=>$module )
		if( IsSet( $module->structure['rec']['fields']['linked'] )){
			
			//Всего
			$sql = 'select count(`id`) as `count` from `'.$module->getCurrentTable().'` where `shw`=1 and `linked` LIKE "%|'.$group['id'].'|%"';
			$t = model::execSql($sql, 'getrow');
			$count_borrowed += $t['count'];
			
			//За месяц
			$sql = 'select count(`id`) as `count` from `'.$module->getCurrentTable().'` where `date_public`>"'.date("Y-m-d", strtotime("-1 month")).'" and `shw`=1 and `linked` LIKE "%|'.$group['id'].'|%"';
			$t = model::execSql($sql, 'getrow');
			$count_month += $t['count'];
		}
	// Обновляем	
	model::execSql('update `groups_rec` set `count_recs`='.$count_recs.', `count_borrowed`='.$count_borrowed.', `count_month`='.$count_month.' where `id`='.$group['id'].' limit 1', 'update');
}
pr('Подсчёт количества записей в группах');



// Количество записей в блогах
$sql = 'select `blogs_rec`.`id`, count(`posts_rec`.`id`) as `count` from `blogs_rec` inner join `posts_rec` on `posts_rec`.`blog`=`blogs_rec`.`id` group by `blogs_rec`.`id`';
$recs = model::execSql($sql, 'getall');
foreach($recs as $rec)
	model::execSql('update `blogs_rec` set `count_recs`='.$rec['count'].' where `id`='.$rec['id'].' limit 1','update');
pr('Индексация количества записей в блогах.');




print('<hr /><br />Finished in '.date("Y-m-d H:i:s").'.');

?>