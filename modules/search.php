<?php

class search_module extends default_module{

	public $title='����� �� �����';

	// �������� �������� - ���������� ���������� ������
	public function contentPrepare( $record ){
	
		pr_r( $_GET );
		return $record;
	
	}
	
}

?>
