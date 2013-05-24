<?php
App::uses('AppModel', 'Model');

class CategoriesEntity  extends AppModel {

	public $actsAs = array('Ordered'=>array(
		'field'         => 'ordernumber',
		'foreign_key'     => 'category_id'
		)
	);

}

?>