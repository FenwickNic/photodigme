<?php
App::uses('Photo', 'Model');

/**
 * Photo Test Case
 *
 */
class PhotoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.photo',
		'app.entity',
		'app.video',
		'app.text',
		'app.category',
		'app.permission',
		'app.comment',
		'app.user',
		'app.address',
		'app.role',
		'app.categories_user',
		'app.group',
		'app.categories_group',
		'app.groups_user',
		'app.categories_comment',
		'app.comments_entity',
		'app.categories_entity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Photo = ClassRegistry::init('Photo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Photo);

		parent::tearDown();
	}

}
