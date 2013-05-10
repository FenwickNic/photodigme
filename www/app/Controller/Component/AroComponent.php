<?php

class AroComponent extends Component {
	
	private $aroTree = array();
	public $components = array('Acl');
	private $controller = null;
	
	public function initialize(Controller $controller) {
        return true;
    }
	
	public function startup(Controller $controller) {
		$this->controller =& $controller;
		$this->aroTree = $this->Acl->Aro->find('threaded',array(
				'contain' => false,
				'recursive' => -1
				)
			);
	}
	
	public function getTree(){
		return $this->_buildTree($this->aroTree);
	}
	
	public function getUsers($group_id){
		$dmOut = array();
		$group = array('model'=>'Group','foreign_key'=>$group_id);
		$node = $this->Acl->Aro->node($group);
		$aroList = $this->Acl->Aro->children($node[0]['Aro']['id']);
		foreach($aroList as $key=>$aro){
			$model_name =$aro['Aro']['model'];
			$model_id = $aro['Aro']['foreign_key'];
			if($model_name == 'Group'){
				$group = $this->controller->Group->find('first',array('conditions'=>array('id' => $model_id),'recursive'=>-1));
				$dmOut[$key] =  $group;				
			}elseif($model_name == 'User'){
				$user =  $this->controller->User->find('first',array('conditions'=>array('id' => $model_id),'recursive'=>-1));
				$dmOut[$key] = $user;
			}
		}
		return $dmOut;
	}
	
	protected function _buildTree($tree){
		$dmOut = array();
		foreach($tree as $key=>$element){
			$currentAro = $element['Aro'];
			if(!empty($element['children']) && is_array($element['children'])){
				$dmOut[$key]['children'] = $this->_buildTree($element['children']);
				return $dmOut;
			}
			$model_name = $currentAro['model'];
			$model_id = $currentAro['foreign_key'];
			if($model_name == 'Group'){
				$group = $this->controller->Group->find('first',array('conditions'=>array('id' => $model_id),'recursive'=>-1));
				$dmOut[$key]['Group'] = $group['Group'];
				
			}elseif($model_name == 'User'){
				$user =  $this->controller->User->find('first',array('conditions'=>array('id' => $model_id),'recursive'=>-1));
				$dmOut[$key]['User'] = $user['User'];
			}
		}
			
		return $dmOut;
	}
}