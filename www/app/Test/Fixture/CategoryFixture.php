<?php
/**
 * CategoryFixture
 *
 */
class CategoryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 70, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'parent_id' => array('type' => 'string', 'null' => true, 'default' => '1', 'length' => 70, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'permission_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'ordernumber' => array('type' => 'integer', 'null' => false, 'default' => null),
		'creationdate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'lastupdate' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'published' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'publicationdate' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 'Lorem ipsum dolor sit amet',
			'permission_id' => 'Lorem ip',
			'ordernumber' => 1,
			'creationdate' => '2013-05-05 14:09:51',
			'lastupdate' => '2013-05-05 14:09:51',
			'published' => 1,
			'publicationdate' => '2013-05-05 14:09:51'
		),
	);

}
