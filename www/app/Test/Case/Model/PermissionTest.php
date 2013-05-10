<?php
App::uses('Permission', 'Model');

/**
 * Permission Test Case
 *
 */
class PermissionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permission',
		'app.category',
		'app.comment',
		'app.user',
		'app.address',
		'app.role',
		'app.categories_user',
		'app.group',
		'app.categories_group',
		'app.groups_user',
		'app.categories_comment',
		'app.entity',
		'app.photo',
		'app.video',
		'app.text',
		'app.categories_entity',
		'app.comments_entity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Permission = ClassRegistry::init('Permission');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Permission);

		parent::tearDown();
	}

}
