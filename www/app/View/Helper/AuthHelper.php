<?php 

/*
 *This helper provide access to user parameters such as username, id, etc., of currently logged in user
 *Send comments and feature request to ragrawal at gmail dot com
 *@author - Ritesh Agrawal
 *@version 0.1.0 
 *@license MIT
 */
  
class AuthHelper extends Helper {
	

    var $hashKey = null;
    var $initialized = false;
    var $helpers = array ('Session','Html');
    
    /**
     * Initialize AuthHelper
     */
    function init() {        
        if (!$this->initialized) {
            if (!isset ($this->view)) {
                $this->view = & ClassRegistry :: getObject('view');
            }
            if (!empty ($this->view->viewVars['authSessionKey'])) {
                $this->hashKey = $this->view->viewVars['authSessionKey'];
            }
            $this->initialized = true;
        }
    }

    /***
     * Check whether a user is logged in or not
     */
    function sessionValid(){
        $this->init();
        return ($this->Session->check($this->hashKey));
    }

    /*
     * Retrieve user information
     *@param string $key - user table field such as username, id, etc.
     *@return  if valid then then value otherwise false;
     */
    function user($key) {
        $this->init();
        // does session exists
        if ($this->sessionValid()) {
            $user = $this->Session->read($this->hashKey);
            if (isset($user[$key])) {
                return $user[$key];
            }
        }
        return false;
    }
	
	function displayAuthWidget(){
		
		$widget = '';
		
		if($this->Session->check('Auth.User')){
			$user = $this->Session->read('Auth.User');
			$firstname = $user['firstname'];
			$lastname = $user['lastname'];
 
			$widget = '<li class="dropdown">';
			$widget .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
			$widget .=	$firstname . ' ' . $lastname;
			$widget .=	'<b class="caret"></b>';
			$widget .=	'</a>';
			$widget .=	'<ul class="dropdown-menu">';
			$widget .=	'<li>'.$this->Html->link(__('Mon compte'),array('controller'=>'users','action'=>'view')).'</li>';
			if($user['group_id'] == 3){
				$widget .=	'<li>'.$this->Html->link(__('Administrer'),array('admin'=>true,'controller'=>'users','action'=>'manage')).'</li>';
			}
			$widget .=	'<li>'.$this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout')).'</li>';
			$widget .= '</ul>';
			$widget .= '</li>';
		}else{
			$widget = $this->Html->link('Login', array('controller'=>'users','action'=>'login'));
		}
		return $widget;
	}

}
?> 