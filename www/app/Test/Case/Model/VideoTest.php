<?php
App::uses('Video', 'Model');

/**
 * Video Test Case
 *
 */
class VideoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.video',
		'app.entity',
		'app.photo',
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
		$this->Video = ClassRegistry::init('Video');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Video);

		parent::tearDown();
	}

}
