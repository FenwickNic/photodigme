<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 */
class CategoriesController extends AppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	
	public function beforeFilter() {
		$this->Category->moveUp(1,1);
		parent::beforeFilter();
		$this->Auth->allow('view');
		$user_id = $this->Auth->user('id');
		if(isset($this->request['pass'][0])){
			$category_id = intval($this->request['pass'][0]);
		}else{
			$this->redirect(array('controller' => 'errors', 'action' => 'error404'));
		}
		if(!$user_id){
			if(!$this->Acl->check(array('model' => 'Group', 'foreign_key' => 1),array('model'=>'Category','foreign_key'=> $category_id),'read')){
				$this->redirect(array('controller' => 'errors', 'action' => 'accessRestricted'));
			}
		}else{
			if(!$this->Acl->check(array('model' => 'User', 'foreign_key' => $user_id),array('model'=>'Category','foreign_key'=> $category_id),'read')){
				$this->redirect(array('controller' => 'errors', 'action' => 'accessRestricted'));
			}
		}		  
	}
	
	public function view(){
		$category_id = -1;
		if(isset($this->request['pass'][0])){
			$category_id = $this->request['pass'][0];
		}
		$category = $this->Category->find('first',array(
			'conditions'=>array(
				'Category.id'=> $category_id,
				'Category.published'=>1,
				'OR'=>array(
					'Category.publicationdate'=>null,
					'Category.publicationdate <= NOW()'
				)				
			),
			'contain' => array(
				'Entity.Photo'
				,'Entity.Video'
				,'Entity.Text'
			)
		));
		if(empty($category)){
			$this->redirect(array('controller' => 'errors', 'action' => 'error404'));
		}
		$this->set(compact('category'));
	}
}
