<?php
App::uses('Category', 'Model');

/**
 * Category Test Case
 *
 */
class CategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.category',
		'app.permission',
		'app.aro',
		'app.aco',
		'app.comment',
		'app.categories_comment',
		'app.entity',
		'app.categories_entity',
		'app.group',
		'app.categories_group',
		'app.user',
		'app.address',
		'app.role',
		'app.categories_user',
		'app.groups_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Category = ClassRegistry::init('Category');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Category);

		parent::tearDown();
	}

}
