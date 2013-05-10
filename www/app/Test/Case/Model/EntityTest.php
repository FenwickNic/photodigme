<?php
App::uses('Entity', 'Model');

/**
 * Entity Test Case
 *
 */
class EntityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.entity',
		'app.photo',
		'app.video',
		'app.text',
		'app.category',
		'app.permission',
		'app.aro',
		'app.aco',
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
		$this->Entity = ClassRegistry::init('Entity');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entity);

		parent::tearDown();
	}

}
