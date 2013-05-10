<?php
App::uses('AppModel', 'Model');
/**
 * Entity Model
 *
 * @property Photo $Photo
 * @property Video $Video
 * @property Text $Text
 * @property Category $Category
 * @property Comment $Comment
 */
class Entity extends AppModel {

	public $actAs = array('Acl' => array('type' => 'controlled'));
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Photo' => array(
			'className' => 'Photo',
			'foreignKey' => 'photo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'video_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Text' => array(
			'className' => 'Text',
			'foreignKey' => 'text_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'categories_entities',
			'foreignKey' => 'entity_id',
			'associationForeignKey' => 'category_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Comment' => array(
			'className' => 'Comment',
			'joinTable' => 'comments_entities',
			'foreignKey' => 'entity_id',
			'associationForeignKey' => 'comment_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	public function afterFind($results, $primary = false) {
		return Set::filter($results, true);
	}

}
