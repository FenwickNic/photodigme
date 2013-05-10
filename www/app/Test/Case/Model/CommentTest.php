<?php
App::uses('Comment', 'Model');

/**
 * Comment Test Case
 *
 */
class CommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.comment',
		'app.user',
		'app.address',
		'app.role',
		'app.category',
		'app.permission',
		'app.aro',
		'app.aco',
		'app.categories_comment',
		'app.entity',
		'app.categories_entity',
		'app.group',
		'app.categories_group',
		'app.groups_user',
		'app.categories_user',
		'app.comments_entity'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comment = ClassRegistry::init('Comment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comment);

		parent::tearDown();
	}

}
