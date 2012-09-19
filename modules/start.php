<?php

class start_module extends default_module{

	public $title='Статьи';

	public $items_per_page = 10;

	//Шаблоны в модуле по умолчанию
	public $prepares=array(
		'footer' => array( 'function' => 'prepareFooter', 'title' => 'Меню внизу страницы' ),
		'city' => array( 'function' => 'prepareCity', 'title' => 'Города' ),
		'newcity' => array( 'function' => 'prepareNewCity', 'title' => 'Новый город' ),
        'comments' => array( 'function' => 'prepareComments', 'title' => 'Комментарии' ),
        'commentors' => array( 'function' => 'prepareCommentors', 'title' => 'Комментаторы' ),
		'myvote' => array( 'function' => 'prepareMyVote', 'title' => 'Голосовал ли я' ),
		'stat' => array( 'function' => 'prepareStat', 'title' => 'Статистика' ),
	);

	public function setStructure() {
		$this->structure=array(
			'rec'=>array(
				'title'=>$this->title,
				'fields'=>array(
					'text'=>			array('type'=>'text_editor','group'=>'main','title'=>'Текст'),
					'show_in_menu'=>	array('type'=>'check','group'=>'show','title'=>'Показывать в главном меню','default'=>false),
					'show_in_footer'=>	array('type'=>'check','group'=>'show','title'=>'Показывать в подвале','default'=>false),
				),
				'type'=>'tree',
				'dep_path'=>false,
				'dep_param'=>false,
			),
		);
	}

	//Установка интерфейсов модуля
	public function setInterfaces(){
		
		$this->interfaces=array(
			'graph_start'=>array(
				'title'=>'Начало связи графа',		//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'top1'=>array('sid'=>'top1','type'=>'text'),
					'type'=>array('sid'=>'type','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>true,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,						//Использовать ли уже имеющуюся запись
				'control'=>'graphLink_start',					//Функция, отвечающая за обработку интерфейса после отправки
			),
			'graph_finish'=>array(
				'title'=>'Окончание связи графа',		//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'id'=>array('sid'=>'id','type'=>'text'),
					'top2'=>array('sid'=>'top2','type'=>'text'),
					'type'=>array('sid'=>'type','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>true,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,						//Использовать ли уже имеющуюся запись
				'control'=>'graphLink_finish',					//Функция, отвечающая за обработку интерфейса после отправки
			),
			'graph_link'=>array(
				'title'=>'Связь',		//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'id'=>array('sid'=>'id','type'=>'text'),
					'top1'=>array('sid'=>'top1','type'=>'text'),
					'top2'=>array('sid'=>'top2','type'=>'text'),
					'type'=>array('sid'=>'type','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>true,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,						//Использовать ли уже имеющуюся запись
				'control'=>'graphLink_link',					//Функция, отвечающая за обработку интерфейса после отправки
			),
			'graph_unlink'=>array(
				'title'=>'Убрать Связь',		//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'id'=>array('sid'=>'id','type'=>'text'),
					'top1'=>array('sid'=>'top1','type'=>'text'),
					'top2'=>array('sid'=>'top2','type'=>'text'),
					'type'=>array('sid'=>'type','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>true,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,						//Использовать ли уже имеющуюся запись
				'control'=>'graphLink_unlink',					//Функция, отвечающая за обработку интерфейса после отправки
			),
			'thanks'=>array(
				'title'=>'Сказать спасибо человеку',		//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'id'=>array('sid'=>'id','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>true,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,						//Использовать ли уже имеющуюся запись
				'control'=>'sayThanks',					//Функция, отвечающая за обработку интерфейса после отправки
			),
			'comm_vote'=>array(
				'title'=>'Проголосовать за комментарий',//Название интерфейса
				'structure_sid'=>'rec',					//Используемая структура текущего модуля
				'fields'=>array(
					'id'=>array('sid'=>'id','type'=>'text'),
				),										//Поля, доступные в интерфейсе
				'ajax'=>true,
				'protection'=>false,					//Защита формы
				'auth'=>false,							//Требуется ли авторизация для работы с интерфейсом
				'use_record'=>false,					//Использовать ли уже имеющуюся запись
				'control'=>'commVote',					//Функция, отвечающая за обработку интерфейса после отправки
			),
		);
	}

	//Личное меню пользователя
	public function prepareFooter($params){

		//Получаем условия
		$where=$this->convertParamsToWhere($params);

		//Условия отображения на сайте
		$where['and'][]='`show_in_footer`=1';

		//Сортировка
		$order=$this->getOrderBy('rec');

		//Забираем записи
		$recs=model::makeSql(
			array(
				'tables'=>array($this->getCurrentTable('rec')),
				'where'=>$where,
				'order'=>$order,
			),
			'getall'
		);

		//Раскрываем сложные поля
		if($recs)
		foreach($recs as $i=>$rec){
			$rec=$this->explodeRecord($rec,'rec');
			$rec=$this->insertRecordUrlType($rec);
			$recs[$i]=$rec;
		}

		//Готово
		return $recs;
	}
	
	//Личное меню пользователя
	public function prepareCity($params){
		//Забираем записи
		$recs=model::execSql('select * from `domains` where `active`=1 and `id`>1 order by `shirt`','getall');
		
		//Готово
		return $recs;
	}
	
	//Личное меню пользователя
	public function prepareNewCity($params){
		//Забираем записи
		$rec=model::execSql('select * from `domains` where `active`=1 and `new`=1 and (not(`id`='.model::pointDomainID().')) order by RAND()','getrow');
		//Готово
		return $rec;
	}
	

	//Личное меню пользователя
	public function prepareComments($params){
		//Получаем условия
		$where=$this->convertParamsToWhere($params);
		$where['and']['tree_level']='`tree_level`>1';
		if( IsSet($params['author']) )$where['and']['author']='`author`="'.mysql_real_escape_string($params['author']).'"';
		
		$limit='';
		if($params['limit'])$limit='limit '.mysql_real_escape_string($params['limit']);
		
		//Требуется разбивка на страницы
		if( $params['chop_to_pages'] ){

			//Текущая страница
			$current_page = model::$ask->rec['page'];

			//Всего записей по запросу
			$num_of_records = model::execSql('select count(`id`) as `counter` from `comments` where '.implode(' and ', $where['and']).' and '.model::pointDomain().'','getrow');
			$num_of_records = $num_of_records['counter'];

			$where['and']['access']=false;

			//Записей на страницу
			if(IsSet($params['items_per_page']))$items_per_page=$params['items_per_page'];
			elseif(IsSet(model::$settings['items_per_page']))$items_per_page=model::$settings['items_per_page'];
			else $items_per_page=10;

			//Выбирать комментариитолько по одному разделу
			if(IsSet($params['mod']))
                $where['and']['module']='`module`="'.mysql_real_escape_string($params['mod']).'"';

			//Количество страниц
			$num_of_pages = ceil( $num_of_records / $items_per_page );

			//Забираем записи
			$recs=model::makeSql(
				array(
					'tables'=>array('comments'),
					'where'=>$where,
					'order'=>'order by `date` desc',
					'limit'=>'limit '.($current_page*$items_per_page).', '.$items_per_page,
				),
				'getall'
			);//pr(model::$last_sql);

			//Раскрываем сложные поля
			if($recs)
			foreach($recs as $i=>$rec){
                $rec['date'] = model::$types['datetime']->getValueExplode($rec['date']);
				$recs[$i]=$rec;
			}

			//Перелистывания страниц
			$pages=array();
			if( $num_of_pages > 1 ){

				//Учитываем GET-переменные
				$get_vars=false;
				if(IsSet($_GET))
					foreach($_GET as $var=>$val){
						if( is_array($val) ){
							foreach($val as $v)
								$get_vars[]=$var.'[]='.$v;
						}else{
							$get_vars[]=$var.'='.$val;
						}
					}

				//Учитываем другие модификаторы
				$modifiers=false;
				if( count(model::$ask->mode)>0 ){
					$modifiers='.'.implode('.', model::$ask->mode);
				}

				//Зацикливаем перелистывание страниц вправо и влево.
				if($current_page>0)$prev=$current_page-1;else $prev=$pages['count']-1;
				if($current_page<$pages['count']-1)$next=$current_page+1;else $next=0;

				//Предыдущая страница
				$pages['prev']['url'] = model::$ask->rec['url'].$modifiers.'.'.$prev.'.'.model::$ask->output.($get_vars?'?'.implode('&', $get_vars):'');
				$pages['prev']['num'] = $prev;

				//Следующая страница
				$pages['next']['url'] = model::$ask->rec['url'].$modifiers.'.'.$next.'.'.model::$ask->output.($get_vars?'?'.implode('&', $get_vars):'');
				$pages['next']['num'] = $next;

				//Другие страницы
				for($i=0;$i<$num_of_pages;$i++){
					$pages['items'][$i]['url']=model::$ask->rec['url'].$modifiers.'.'.$i.'.'.model::$ask->output.($get_vars?'?'.implode('&', $get_vars):'');
				}
			}

			//Результат
			$result=array(
				'current'	=>	$current_page,									//Номер текущей страницы
				'from'		=>	$current_page*$items_per_page,					//Номер первой записи на странице
				'till'		=>	($current_page+1)*$items_per_page,				//Номер последней записи на странице
				'limit'		=>	$items_per_page,								//Количество записей на странице
				'count'		=>	ceil($num_of_records / $items_per_page),		//Общее количество страниц
				'recs'		=>	$recs,											//Все записи на странице
				'pages'		=>	$pages,											//Страницы
			);

			//Готово
			return $result;

		//Без разбивки на страницы
		}else{

            $where['and']['access']=false;

			//Выбирать комментариитолько по одному разделу
			if(IsSet($params['mod']))
                $where['and']['module']='`module`="'.mysql_real_escape_string($params['mod']).'"';

			//Забираем записи
			$recs=model::makeSql(
				array(
					'tables'=>array('comments'),
					'where'=>$where,
					'order'=>'order by `date` desc',
					'limit'=>$limit,
				),
				'getall'
			);//pr(model::$last_sql);

            foreach($recs as $i=>$rec){
                $recs[$i]['author'] = model::$types['user']->getValueExplode($rec['author']);
                $recs[$i]['date'] = model::$types['datetime']->getValueExplode($rec['date']);
                $recs[$i]['url'] = $this->insertRecordUrlType($rec['url']);
            }

			//Готово
			return $recs;
		}
	}

    //Комментаторы к записи
    public function prepareCommentors($params){
        list($module, $structure_sid, $record_id) = explode('|', $params['top']);

        $where = array(
            'module' => '`module`="'.mysql_real_escape_string($module).'"',
            'structure_sid' => '`structure_sid`="'.mysql_real_escape_string($structure_sid).'"',
            'record_id' => '`record_id`="'.mysql_real_escape_string($record_id).'"',
        );

        //Забираем авторов
        $t=model::execSql('select distinct `author` from `comments` where '.implode(' and ', $where).' and `author`>0', 'getall');
        $ids = array();
        foreach($t as $ti)$ids[] = $ti['author'];

        $recs = model::execSql('select * from `users` where `id` IN ('.implode(',',$ids).')','getall');

        //Раскрываем сложные поля
        if($recs)
        foreach($recs as $i=>$rec){
            $rec=model::$modules['users']->explodeRecord($rec,'rec');
            $rec=model::$modules['users']->insertRecordUrlType($rec);

            $recs[$i]=$rec;
        }

        //Готово
        return $recs;
    }

 	//Дополнительная обработка записи при типе вывода "content"
	public function contentPrepare($rec,$structure_sid='rec'){
		
		//Статистика
		if($rec['sid'] == 'stat'){
		
			$graphs = array(
				array('id'=>'graph_visits', 'type'=>'visits', 'title'=>'Количество посещений в день', 'width'=>'550', 'height'=>'300'),
				array('id'=>'graph_views', 'type'=>'views', 'title'=>'Просмотров страниц в день', 'width'=>'550', 'height'=>'300'),
				array('id'=>'graph_geo', 'type'=>'geo', 'title'=>'География посетителей по городам', 'width'=>'550', 'height'=>'300'),
				array('id'=>'graph_age', 'type'=>'age', 'title'=>'Демография посетителей', 'width'=>'550', 'height'=>'300')
			);
			
			foreach($graphs as $graph){
				if(substr_count($rec['text'], '['.$graph['id'].']')){
					$rec['text'] = str_replace('['.$graph['id'].']', $this->makeGraph($graph), $rec['text']);
				}
			
			}
		}
		
		@list($rec['city_center']['x'],$rec['city_center']['y'],$rec['city_center']['z']) = explode('|', model::$settings['city_center']);
		return $rec;
	}
	//Построитель графиков
	private function makeGraph($params){
	
		//Количество посещений в день
		if($params['type'] == 'visits'){
			$cols[]=array('type'=>'string', 'title'=>'Task');
			$cols[]=array('type'=>'number', 'title'=>'посетителей');
			
			$data=unserialize(model::$settings['ga_stat']);
			if(is_array($data['visits']))
			foreach($data['visits'] as $val)
				$vals[]=array('title'=>$val['label'], 	'value'=>$val['value']);
			
			$graph=array(
				'id'=>$params['id'],
				'title'=>$params['title'],
				'width'=>$params['width'],
				'height'=>$params['height'],
				'legend'=>'none',
				'type'=>'AreaChart',
				'cols'=>$cols,
				'vals'=>$vals,
			);
		
		//Просмотров страниц в день
		}elseif($params['type'] == 'views'){
			$cols[]=array('type'=>'string', 'title'=>'Task');
			$cols[]=array('type'=>'number', 'title'=>'просмотров');
			
			$data=unserialize(model::$settings['ga_stat']);
			if(is_array($data['views']))
			foreach($data['views'] as $val)
				$vals[]=array('title'=>$val['label'], 	'value'=>$val['value']);
			
			$graph=array(
				'id'=>$params['id'],
				'title'=>$params['title'],
				'width'=>$params['width'],
				'height'=>$params['height'],
				'legend'=>'none',
				'type'=>'AreaChart',
				'cols'=>$cols,
				'vals'=>$vals,
			);
		
		
		
		//География посетителей по городам
		}elseif($params['type'] == 'geo'){
			$cols[]=array('type'=>'string', 'title'=>'Task');
			$cols[]=array('type'=>'number', 'title'=>'просмотров');
			
			$vals[]=array('title'=>'Екатеринбург', 	'value'=>67153);
			$vals[]=array('title'=>'Москва', 		'value'=>44993);
			$vals[]=array('title'=>'Пермь', 		'value'=>17703);
			$vals[]=array('title'=>'Челябинск', 	'value'=>56744);
            $vals[]=array('title'=>'Уфа', 			'value'=>8950);
            $vals[]=array('title'=>'Новосибирск', 	'value'=>4521);
            $vals[]=array('title'=>'Ростов', 		'value'=>2470);

			$graph=array(
				'id'=>$params['id'],
				'title'=>$params['title'],
				'width'=>$params['width'],
				'height'=>$params['height'],
				'legend'=>'right',
				'type'=>'PieChart',
				'cols'=>$cols,
				'vals'=>$vals,
			);
		
		//Демография посетителей
		}elseif($params['type'] == 'age'){
		}
	

		//Текущий шаблон
		$current_template_file = '../mobi/graph.tpl';
	
		//Подключаем шаблонизатор
		require_once(model::$config['path']['core'] . '/classes/templates.php');
		$tmpl = new templater($this->model);

		$tmpl->assign('graph', $graph);

		$template_file_path = model::$config['path']['templates'] . '/' . $current_template_file;

		$ready_html = $tmpl->fetch($current_template_file);
		return $ready_html;
	
	}

	
	public function graphLink_start($values){
		//Добавляем запись
		$result=model::$extensions['graph']->start(
			array(
				'top1'	=>	$values['top1'], 
				'type'	=>	$values['type']
			)
		);
		//Готовпим ответ
		$this->ansver('link', $values, $result);
	}
	
	public function graphLink_finish($values){
		//Добавляем запись
		$result=model::$extensions['graph']->finish(
			array(
				'top1'	=>	$values['top1'],
				'top2'	=>	$values['top2'],
				'type'	=>	$values['type'],
				'text'	=>	@$values['text']
			)
		);
		//Готовпим ответ
		$this->ansver('link', $values, $result);
	}
	
	public function graphLink_link($values){
		//Добавляем запись
		$result=model::$extensions['graph']->link(
			array(
				'top1'	=>	$values['top1'],
				'top2'	=>	$values['top2'],
				'type'	=>	$values['type'],
				'text'	=>	@$values['text']
			)
		);
		//Готовпим ответ
		$this->ansver('link', $values, $result);
	}
	
	public function graphLink_unlink($values){
		//Добавляем запись
		$result=model::$extensions['graph']->unlink(
			array(
				'top1'	=>	$values['top1'],
				'top2'	=>	$values['top2'],
				'type'	=>	$values['type'],
				'text'	=>	@$values['text']
			)
		);
		//Готовпим ответ
		$this->ansver('unlink', $values, $result);
	}
	
	//Ответ на запрос к графу
	private function ansver($action, $values, $result){
	
		//Действие выполнено
		if($result == 'ok'){
			//Готовпим текст ответа
			$text=model::$extensions['graph']->links[$values['type']][$action];
			if(substr_count($text,'[1]')){
				list($module, $structure_sid, $record_id)=explode('|',$values['top1']);
				$rec=model::$modules[$module]->getRecordById($structure_sid, $record_id);
				$text=str_replace('[1]','<a href="'.$rec['url'].'">'.$rec['title'].'</a>',$text);
			}
			if(substr_count($text,'[2]')){
				list($module, $structure_sid, $record_id)=explode('|',$values['top2']);
				$rec=model::$modules[$module]->getRecordById($structure_sid, $record_id);
				$text=str_replace('[2]','<a href="'.$rec['url'].'">'.$rec['title'].'</a>',$text);
			}
			
			//Результат
			$result=array(
				'result'=>'message',
				'message'=>$text,
				'class'=>'ok',
				'close'=>false,
			);
		
		}elseif($result == 'start'){
			//Результат
			$result=array(
				'result'=>'message',
				'message'=>'Теперь выберите вторую запись для связки',
				'class'=>'ok',
				'close'=>false,
			);
		}else{
			//Результат
			$result=array(
				'result'=>'message',
				'message'=>$result,
				'class'=>'warn',
				'close'=>false,
			);
		}
		//Ответ
		$this->answerInterface($values['interface'],$result);
	}
	
	public function prepareMyVote($values){
		list($module, $structure_sid, $record_id) = explode('|', $values['top']);
		$rec = model::execSql('select * from `votes` where `module`="'.$module.'" and `structure_sid` = "'.$structure_sid.'" and `record_id`="'.$record_id.'" and `author`="'.user::$info['id'].'" limit 1', 'getrow');
//		pr(model::$last_sql);
		return $rec;
	}
	
	public function prepareStat($values){
		$t = model::execSql('select count(`id`) as `counter` from `users`','getrow');
		$users = $t['counter'];
		
		$t = model::execSql('select count(`id`) as `counter` from `tarifs_rec`','getrow');
		$tarifs = $t['counter'];
		
		$t = model::execSql('select count(`id`) as `counter` from `gallery_rec`','getrow');
		$gallery = $t['counter'];
		
		$t = model::execSql('select count(`id`) as `counter` from `posts_rec`','getrow');
		$posts = $t['counter'];
		
        $t = model::execSql('select count(`id`) as `counter` from `gadgets_rec`','getrow');
        $gadgets = $t['counter'];
		
        $t = model::execSql('select count(`id`) as `counter` from `price_rec`','getrow');
        $prices = $t['counter'];

		$news = model::execSql('select * from `posts` where `shw`=1','getall');
		
		$rec=array(
			'users' => $users,
			'tarifs' => $tarifs,
			'gallery' => $gallery,
			'posts' => $posts,
            'gadgets' => $gadgets,
            'prices' => $prices,
		);

		return $rec;
	}
	
	//Сказать спасибо человеку за запись
	public function sayThanks($values){
		list($module, $structure_sid, $record_id) = explode('|', $values['top']);
		$record = model::$modules[ $module ]->getRecordById($structure_sid, $record_id);
		$record = model::$modules[ $module ]->explodeRecord($record, $structure_sid);
		
		model::$types['rating']->addThanks($record['author']['id']);
		
		//Добавляем запись в граф
		$result=model::$extensions['graph']->link(
			array(
				'top1'	=>	$values['top'],
				'top2'	=>	'users|rec|'.$record['author']['id'],
				'type'	=>	'thanks',
				'text'	=>	''
			)
		);

		//Результат
		$result=array(
			'result'=>'message',
			'message'=>'Пожалуйста!',
			'close'=>false,
		);
		$this->answerInterface($values['interface'],$result);
	}
	
	public function commVote($values){
		
		if( user::$info['id']<1 ){
			print('reg');
			exit();
		}
		
		if( !in_array( $values['value'], array(-1, 1) ) ){
			print('wrong_vote');
			exit();
		}
		
		//Ищем голос
		$my_vote = $this->prepareMyVote( array('top'=>'comments|rec|'.$values['id']) );
		
		//Уже голосовали
		if( IsSet($my_vote['id']) ){
			print('already_voted');
			exit();
		}
		
		//Добавляем голос
		model::$types['votes']->addVote('comments', 'rec', $values['id'], $values['value']);
		
		//Готово
		print('ok');
		exit();
	}
	
}

?>
