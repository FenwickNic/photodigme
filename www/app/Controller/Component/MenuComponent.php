<?php

class MenuComponent extends Component {

	public $components = array('Acl', 'Auth');
	private $menu = null;
	private $Controller = null;
	private $user_id;
	private $group_id = 1;
	
	public function initialize(Controller $controller) {
        return true;
    }
	
	public function startup(Controller $controller) {
		$user_id = $this->Auth->user('id');
		if(!$user_id) {
			$this->group_id = 1;
        }else{
			$this->user_id = $user_id;
		}
		$this->Controller =& $controller;
		$categories = $this->Controller->Category->find('threaded',array(
				'contain' => false,
				'conditions'=> array(
					'Category.published'=>1,
					array(
						'OR'=>array(
							'Category.publicationdate <= NOW()','Category.publicationdate'=>null
						)
					)
				),
				'order'=>'lft ASC'
			)
		);
		$this->menu = $this->_formatMenu($categories);
	}

	/**
	* BeforeRender Callback.
	*
	*/
	public function beforeRender(Controller $controller) {
		$this->Controller->set('menu_data', $this->menu);
		$this->Controller->set('breadcrumb', $this->breadcrumb);
	}

	/**
	* Recursive function to construct Menu
	*
	* @param unknown_type $menu
	* @param unknown_type $parentId
	*/
	protected function _formatMenu($categoryList) {
		$arrayOut = array();
		foreach($categoryList as $key => $item ) {
			
			$childCategory = $item['children'];
			if(is_array($childCategory)){
				$arrayOut[$key]['children'] =  $this->_formatMenu($childCategory);
			}			
			if(!isset($this->user_id)){
				
				if($this->Acl->check(array('model' => 'Group', 'foreign_key' => 1),array('model'=>'Category','foreign_key'=> intval($item['Category']['id'])))){
					$arrayOut[$key]['Category'] = $item['Category'];
				}else{
					unset($arrayOut[$key]);
				}
			}else{
				if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->user_id),array('model'=>'Category','foreign_key'=> intval($item['Category']['id'])))){
					$arrayOut[$key]['Category'] = $item['Category'];
				}else{
					unset($arrayOut[$key]);
				}
			}
		}
		return $arrayOut;
	}
}
?>