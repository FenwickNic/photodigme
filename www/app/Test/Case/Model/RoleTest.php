<?php
App::uses('Role', 'Model');

/**
 * Role Test Case
 *
 */
class RoleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.role',
		'app.user',
		'app.address',
		'app.comment',
		'app.category',
		'app.permission',
		'app.categories_comment',
		'app.entity',
		'app.photo',
		'app.video',
		'app.text',
		'app.categories_entity',
		'app.comments_entity',
		'app.group',
		'app.categories_group',
		'app.groups_user',
		'app.categories_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Role = ClassRegistry::init('Role');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Role);

		parent::tearDown();
	}

}
