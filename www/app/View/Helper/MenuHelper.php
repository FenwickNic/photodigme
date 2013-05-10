<?php
 App::uses('AppHelper', 'View/Helper');
 
class MenuHelper extends AppHelper {
	
	public $helpers = array('Html');
	/**
	 * Current page in application
	 *
	 * @var string
	 */
	private $selected = '';
 
	/** Internal variable for the data
	 *
	 * @var array
	 */
	private $array = array();
 
	/**
	 * Default css class applied to the menu
	 *
	 * @var string
	 */
	private $menuClass = 'menu';
 
	/**
	 * Default DOM id applied to menu
	 *
	 * @var string
	 */
	private $menuId = 'top-menu';
 
	/**
	 * CSS class applied to the selected node and its parent nodes 
	 *
	 * @var string
	 */
	private $selectedClass = 'selected';
 
	/**
	 * CSS class applied to the exact selected node in the tree - in addition to $selectedClass
	 *
	 * @var unknown_type
	 */
	private $selectedClassItem = 'item-selected';
 
	/**
	 * Default Slug
	 *
	 * @var string
	 */
	private $defaultSlug = 'home';
 
	/**
	 * Type of menu to be generated:
	 * 'tree' - to generate a complete tree
	 * 'context' - to only render the specific barnch under the current page
	 *
	 * @var string
	 */
	private $type = 'tree';
 
	/**
	 * Model name used in $array e.g. $data[0]['Article']['name']
	 *
	 * @var string
	 */
	private $modelName = 'Article';
 
	/**
	 * Database column name - (i.e. a shorter version of the name / title for use only in naviagtion)
	 * e.g. A page called 'Welcome to the giant flea circus' 
	 * might be set to show up on navigation as 'home'
	 *
	 * @var string
	 */
	private $titleForNavigation = 'title_for_navigation';
 
	/**
	 * Database column name for title / name
	 * @var string
	 */
	private $title = 'name';
 
	/**
	 * Database column name for complete page slug e.g. /about/history/early-years
	 *
	 * @var string
	 */
	private $slugUrl = 'slug_url';
 
	/**
	 * Database column name for redirect_url for instance if /about/blog redirects to http://blog.somewebsite.com
	 *
	 * @var string
	 */
	private $redirectUrl = 'redirect_url';
 
	/**
	 * Target for redirect (see redirectUrl)
	 *
	 * @var string
	 */
	private $redirectTarget = 'redirect_target';
 
	/**
	 * Minumum number of items required to render a context menu
	 *
	 * @var int
	 */
	private $contextMinLength = 2;
 
	/**
	 * Internal Counter used in type: 'context'
	 *
	 * @var int
	 */
	private $li_count = 0;
 
	/**
	 * Internal flag to see if the page has been matched to an item
	 *
	 * @var bool
	 */
	private $matched = false;
 
	/**
	 * Internal counter
	 *
	 * @var int
	 */
	private $i = 0;
 
	/**
	 * Enter description here...
	 *
	 * @var unknown_type
	 */
	private $rootNode = '';
 
	function __construct(){
 
	}
 
	public function setOption($key, $value){
		$this->{$key} = $value;
	}
 
	public function getOption($key){
		return $this->{$key};
	}
 
	/**
	 * Setup the helper and return a string to echo
	 *
	 * @param array $array Data array containing the lists
	 * @param array $config Configuration variables to override the defaults
	 * @return string
	 */
	public function setup($array, $config = array()){
 
		// update and override the default variables 
		if(!empty($config)){
			foreach ($config as $key => $value) {
				$this->setOption($key, $value);
			}
		}
 
		// set the default slug selected if the current page does not match
		if($this->selected == '/'){
			$this->selected = $this->defaultSlug;
		}
 
		$this->array = $array;
 
 
 
		// get the root node of the selected tree if this a context menu
		if($this->type == 'context'){
			$this->rootNode = $this->getRootNode($this->selected);
		}
 
		$str = $this->buildMenu();
 
		// if the current page has matched one of the links in the tree
		// then get rid of the 'default_slected' placeholder
		if($this->matched == true){
			$str = str_replace('default_selected', '', $str);
		} else {
			$s = ' class="' . $this->selectedClass . '" ';
			$str = str_replace('default_selected', $s, $str);
		}
 
		// if this is a context menu, it looks daft if it only has 1 item 
		// if this is the case hide it
		if($this->type == 'context'){
			if($this->li_count < $this->contextMinLength){
				$str = '';
			}
		}
 
 
		return $this->output($str);	
 
	}
	/**
	 * Call the menu iterator method and if it returns a string warp it up in a UL
	 *
	 * @return string
	 */
	protected function buildMenu(){
 
		$str = $this->menuIterator($this->array);
 
		if($str != ''){
			$str = '<ul  id="' . $this->menuId . '" class="' . $this->menuClass . '">' . $str . '</ul>';
		}
 
		return $str;
	}
 
	/**
	 * Explode a url slug and get the root page
	 *
	 * @param string $string 
	 * @return string
	 */
	protected function getRootNode($string){
			$rootNode = '';
			if($string != ''){
				$node = explode('/', $string);
				// $node[0] will always be empty becuase the first char of $this->selected will always be '/'
				$rootNode = $node[1];
			}
			return $rootNode;
	}
 
 
	/**
	 * Recursive method to loop down through the data array building menus and sub menus
	 *
	 * @param array $array
	 * @param int $depth
	 * @return string
	 */
	protected function menuIterator($array,$depth = 0){
		$depth++;
		$str = '';
		$is_selected = false;
		foreach($array as $var){
 
			$continue = true;
			$selected = '';
			$sub = '';
 
			if($this->type == 'context' && ($this->getRootNode($var[$this->modelName][$this->slugUrl]) != $this->rootNode)){
				$continue = false;
			}
 
			if($continue == true){
 
				// if this is the first list item set default_selected placeholder
				$default_selected = '';
				if($this->i == 0){
					$this->i = 1;
					$default_selected = 'default_selected';
				}
 
				if(!empty($var['children'])){					
					$sub .= '<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">';
					$sub .= $this->menuIterator($var['children'],$depth);
					$sub .= '</ul>';	
				}
 				$id = $this->getId($var);
				$p = strpos($this->selected, '/categories/view/'.$id);
 
 
				if($p === false){
 
				} elseif($p == 0){
						// this is the selected item or a parent node of the selected item
						$selected = $this->selectedClass;
						$is_selected = true;
						$this->matched = true;
				}
				
				if($this->selected == '/categories/view/'.$id){
					// this is the exact selected item
					$selected = $this->selectedClass . ' ' . $this->selectedClassItem . '" ';
				}
 
				// keep track if this is a contextual menu 
				if($this->type == 'context'){
					$this->li_count++;
				}
 
 
				// Get the name / title to be used for the link text
				$name = $this->getName($var);
				// Get the URL / target for the link
				$url = $this->getUrl($var);
				
				
				$str .= '<li ';
				if(!empty($sub) && $depth ==1){
					$str.= 'class="dropdown '.$selected . ' ' . $default_selected .'" ';
				}
				if(!empty($sub) && $depth ==1){
					$str.= 'class="dropdown-submenu '.$selected . ' ' . $default_selected .'" ';
				}				
				$str .= '>';
					$str .= '<a  href="/categories/view/'.$id.'"><span>' . $name . '</span></a>';
					$str .= $sub;
				$str .= '</li>'; 
			}
		}
		return $str;
	}
	/**
	 * Look in the data and check if this is a straight url
	 * or whether it is actually a redirect
	 *
	 * @param array $var
	 * @return array
	 */
	protected function getUrl($var = null){
			$url = array();
 
			if(isset($var[$this->modelName][$this->redirectUrl]) && !empty($var[$this->modelName][$this->redirectUrl])){
				$url['url'] = $var[$this->modelName][$this->redirectUrl];
				if(isset($var[$this->modelName][$this->redirectTarget]) && !empty($var[$this->modelName][$this->redirectTarget])){
					$url['target'] = ' target="' . $var[$this->modelName][$this->redirectTarget] . '" ';
				}
			} else {
				$url['url'] = $var[$this->modelName][$this->slugUrl];
				$url['target'] = '';
			}
			return $url;
	}
 
	/**
	 * See if there is a title_for_navigation 
	 *
	 * @param array $var
	 * @return string
	 */
	protected function getName($var){
		if(isset($var[$this->modelName][$this->titleForNavigation]) && !empty($var[$this->modelName][$this->titleForNavigation])){
			$name = $var[$this->modelName][$this->titleForNavigation];
		} else {
			$name = $var[$this->modelName][$this->title];
		}
		return $name;
	}
	
		/**
	 * See if there is a title_for_navigation 
	 *
	 * @param array $var
	 * @return string
	 */
	protected function getId($var){
		$id = $var[$this->modelName]['id'];
		return $id;
	}
 
 
 
}
?>