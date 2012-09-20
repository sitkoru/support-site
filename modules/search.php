<?php

class search_module extends default_module{

	public $title='Поиск по сайту';
	public $items_per_page = 15;
	
	public $chop_to_modules = false;

	// Страница контента - показывает результаты поиска
	public function contentPrepare( $record ){
	
		if( IsSet( $_GET['q'] ) ){
			
			// Сюда копим условия поиска по модулю
			$where = array();

			// Условия поиска по полям
			foreach (model::$modules['start']->structure['rec']['fields'] as $field_sid => $field)
				if( (model::$types[ $field['type'] ]->searchable && !IsSet( $field['searchable'] )) || $field['searchable'] )
					$where['or'][] = '`' . $field_sid . '` LIKE "%' . str_replace(' ', '%', $q) . '%"';
			
			// Количество записей на страницу
			$count = $recs_count[0]['counter'];
			$items_per_page = $this->items_per_page;
			if( IsSet( $_GET['items_per_page'] ) )
				$items_per_page = max( 5, intval( $_GET['items_per_page'] ) );
			
			//Записи
			$params = array(
				'where' => '(' . implode(' or ', $where['or']) . ')',
				'chop_to_pages' => true,
				'items_per_page' => $items_per_page,
			);
			pr_r($params);
			
			$record['result'] = model::$modules['start']->prepareRecs( $params );

			pr_r( $record['result'] );
		}
		
		return $record;	
	}

}

?>
