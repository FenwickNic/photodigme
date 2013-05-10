<?php
App::uses('Text', 'Model');

/**
 * Text Test Case
 *
 */
class TextTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.text',
		'app.entity',
		'app.photo',
		'app.video',
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
		$this->Text = ClassRegistry::init('Text');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Text);

		parent::tearDown();
	}

}
