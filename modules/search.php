<?php

class search_module extends default_module{

	public $title='Поиск по сайту';

	// Страница контента - показывает результаты поиска
	public function contentPrepare( $record ){
	
		if( IsSet( $_GET['q'] ) ){
			$record['result'] = $this->compSearch( $_GET );
		}
		
		pr_r( $record['result'] );
		
		return $record;	
	}
	
    // TODO: Поиск по тегам
    // Функция поиска по модулям
    public function compSearch($values){

        // Фильтрация запроса
        $q = mysql_real_escape_string( $values['q'] );

        //Поиск только по структуре rec        
        $structure_sid = 'rec';
        $result = array();

        // Проходим по всем модулям
        foreach (model::$modules as $module_sid => $module) {

            // Пропускаем игнорируемые модули
            if( !IsSet($module->searchable) || !$module->searchable) continue;

            if(method_exists($module,'moduleSearch'))
                $result_recs = $module->moduleSearch($q);
            else
            $result_recs =$this->defaultModuleSearch($module_sid, $structure_sid, $q);

            foreach ($result_recs['recs'] as $i => $rec) {
                $rec=$module->explodeRecord($rec,'rec');
                $rec=$module->insertRecordUrlType($rec);

                $result_recs['recs'][$i] = $rec;
            }
            // Записываем результат
            $result[$module_sid] = array(
                'title'=>$module->title,
                'count'=>$result_recs['count'],
                'recs'=>$result_recs['recs']
            );
        }

        return $result;

    }

    private function defaultModuleSearch($module_sid, $structure_sid, $q)
    {
        // Сюда копим условия поиска по модулю
        $where = array();

        foreach (model::$modules[$module_sid]->structure[$structure_sid]['fields'] as $field_sid => $field)
            // Условия поиска по полям
            if( (model::$types[ $field['type'] ]->searchable && !IsSet( $field['searchable'] )) || $field['searchable'] )
                $where['or'][] = '`' . $field_sid . '` LIKE "%' . str_replace(' ', '%', $q) . '%"';
		
pr_r( $where );
		
        //Получаем количество результатов поиска по структуре
        $recs_count = model::makeSql(
            array(
                 'tables' => array(model::$modules[$module_sid]->getCurrentTable($structure_sid)),
                 'fields' => array( 'count(`id`) as `counter`' ),
                 'where' => $where,
                 'order' => 'order by `date_public` desc'
            ),
            'getall'
        );

pr_r( model::$last_sql );
		
        $count = $recs_count[0]['counter'];

        // TODO: Постраничность
        // Получаем записи относительно структуры
        $recs = model::makeSql(
            array(
                'tables' => array(model::$modules[$module_sid]->getCurrentTable($structure_sid)),
                'where' => $where,
                'order' => 'order by `date_public` desc',
                'limit' => 'limit 0, '.$this->config['items_per_page']
            ),
            'getall'
        );

        return array('count' => $count, 'recs' => $recs);
    }

}

?>
