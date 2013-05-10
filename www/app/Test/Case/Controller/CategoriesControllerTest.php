<?php
App::uses('CategoriesController', 'Controller');

/**
 * CategoriesController Test Case
 *
 */
class CategoriesControllerTest extends ControllerTestCase {

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
		'app.user',
		'app.address',
		'app.group',
		'app.categories_comment',
		'app.entity',
		'app.photo',
		'app.video',
		'app.text',
		'app.categories_entity',
		'app.comments_entity',
		'app.categories_group',
		'app.categories_user'
	);

}
