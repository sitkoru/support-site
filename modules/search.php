<?php

class search_module extends default_module{

	public $title='Поиск по сайту';

	// Страница контента - показывает результаты поиска
	public function contentPrepare( $record ){
	
		pr_r( $_GET );
		return $record;
	
	}
	
}

?>
