<?php
/**
 * EntityFixture
 *
 */
class EntityFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'photo_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'video_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'text_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'photo_id' => 1,
			'video_id' => 1,
			'text_id' => 1
		),
	);

}
