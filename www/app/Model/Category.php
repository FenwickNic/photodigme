<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 * @property Permission $Permission
 * @property Comment $Comment
 * @property Entity $Entity
 * @property Group $Group
 * @property User $User
 */
class Category extends AppModel {

	public $actsAs = array('Tree','Containable','Acl' => array('type' => 'controlled'));
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'joinTable' => 'categories_comments',
			'foreignKey' => 'category_id',
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
		),
		'Entity' => array(
			'className' => 'Entity',
			'joinTable' => 'categories_entities',
			'foreignKey' => 'category_id',
			'associationForeignKey' => 'entity_id',
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
	
	function parentNode() {
		if (!$this->id && empty($this->data)) {
			return null;
		}
		$data = $this->data;
		if (empty($this->data)) {
			$data = $this->read();
		}
		if (!$data['Category']['parent_id']) {
			return null;
		} else {
			return array('Category' => array('id' => $data['Category']['category_id']));
		}
	}

}
