<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Categories Controller
 *
 */
class CategoriesController extends AppController {
	var $uses = array('Entity','Category','Photo','CategoriesEntity');
	var $components = array('Acl');

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('view');
		
	}
	
	/***********************************************************************
	
			PUBLIC FUNCTIONS
	
	*************************************************************************/
	/**
	*	Ability to create Categories, Set or Albums.
	*	Ability to add entity, delete entities, order entities...
	*
	**/
	
	public function admin_manage(){
		$categories = $this->Category->find('all',array(
			'contain'=>false
			,'conditions'=>array(
				'parent_id'=>null
			)
		));

		$photos = $this->Entity->find('all',array(
			'conditions'=> array('NOT'=>array('Entity.photo_id'=>null)),
			'contain' => array('Photo')
			)
		);
		$texts = $this->Entity->find('all',array(
			'conditions'=> array('NOT'=>array('Entity.text_id'=>null)),
			'contain' => array('Text')
			)
		);
		$videos = $this->Entity->find('all',array(
			'conditions'=> array('NOT'=>array('Entity.video_id'=>null)),
			'contain' => array('Video')
			)
		);
		
		$this->set(compact('photos'));
		$this->set(compact('videos'));
		$this->set(compact('texts'));
		$this->set(compact('categories'));
	}
	

	
	/**
	*	View an album.
	*
	*
	**/
	public function admin_overview(){
	
	}
	
	public function view(){
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
	
	/***********************************************************************
	
			AJAX CALLS FUNCTIONS
	
	*************************************************************************/
	
	/**
	*	Ability to getChildren
	*	
	**/
	
	public function admin_getChildren(){
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$categories = $this->Category->find('all',array('conditions'=>array('parent_id'=>$category_id),'contain'=>false));
			$this->set(compact('categories'));
		}
	}
	
		
	/**
	*	Ability to add an entity to a category
	*	
	**/
	
	public function admin_addEntity(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$entity_id = $this->data['entity_id'];
			
			$categoryEntity = array('category_id'=>$category_id,'entity_id'=>$entity_id);
			if($this->CategoriesEntity->save($categoryEntity)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	
		/**
	*	Ability to add an entity to a category
	*	
	**/
	
	public function admin_addcategory(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$name = $this->data['name'];
			
			$category = array('parent_id'=>$category_id,'name'=>$name,'creationdate'=>date('Y-m-d H:i:s'),'lastupdate'=>date('Y-m-d H:i:s'),'published'=>false);
			if($this->Category->save($category)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	/**
	*	Ability to add an entity to a category
	*	
	**/
	
	public function admin_removeentity(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$entity_id = $this->data['entity_id'];
			
			$conditions = array('category_id'=>$category_id,'entity_id'=>$entity_id);
			if($this->CategoriesEntity->deleteAll($conditions)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	/**
	*	Ability to add an entity to a category
	*	
	**/
	
	public function admin_removecategory(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];

			if($this->Category->delete($category_id)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	
	/**
	*	Ability to moveup a category
	*	
	**/
	
	public function admin_moveupcategory(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];

			if($this->Category->moveUp($category_id)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	/**
	*	Ability to moveup a category
	*	
	**/
	
	public function admin_movedowncategory(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];

			if($this->Category->movedown($category_id)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	/**
	*	Ability to moveup a category
	*	
	**/
	
	public function admin_movedownentity(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$entity_id = $this->data['entity_id'];
			
			$conditions = array('category_id'=>$category_id,'entity_id'=>$entity_id);
			$category = $this->CategoriesEntity->find('first',array('conditions'=>$conditions));
			$categoryId = $category['CategoriesEntity']['id'];
			if($this->CategoriesEntity->movedown($categoryId,1)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
		/**
	*	Ability to moveup a category
	*	
	**/
	
	public function admin_moveupentity(){
		$response = false;
		if(!empty($this->data)){
			$category_id = $this->data['category_id'];
			$entity_id = $this->data['entity_id'];
			
			$conditions = array('category_id'=>$category_id,'entity_id'=>$entity_id);
			$category = $this->CategoriesEntity->find('first',array('conditions'=>$conditions));
			$categoryId = $category['CategoriesEntity']['id'];
			if($this->CategoriesEntity->moveup($categoryId,1)){
				$response = true;
			}
		}
		$this->set(compact('response'));
	}
	
	/**
	*	Ability to refresh the current list of pictures to add to any
	*	Album.
	*
	**/
	
	public function admin_refresh(){
		$toProcess = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\pending');
		$original = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\original');
		$error = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\\\error');
		$x800x72 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\800x72');
		$x800x144 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\800x144');
		$x500x72 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\500x72');
		$x500x144 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\500x144');
		$thumbnail = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\120');
		
		$files = $toProcess->find('.*\.jpg');
		
		//$this->out('There are: '.sizeof($files).' files to process...');
		foreach($files as $file){
			try{
				//$this->out('Processing '.$file->name());
				$key = $this->generateKey();

				 $file = new File($toProcess->pwd() . DS . $file);
				$this->generatePhotos($file,$x800x72, $key,800,72);
				$this->generatePhotos($file,$x800x144, $key,800,144);
				$this->generatePhotos($file, $x500x72, $key,500,72);
				$this->generatePhotos($file, $x500x144, $key,500,144);
				$this->generatePhotos($file, $original);
				
				$this->createThumbnail($file,$key);
				$this->storePhotos($file, $key);
				$file->delete();				
				
				//$this->out('[SUCCESS] Created '.$key);
			}catch(Exception  $e){
				storePhoto($file, $this->error);
				//$this->out('[ERROR] Impossible to generate '.$file->name());
			}
		}
	}
	
	/***********************************************************************
	
			PRIVATE FUNCTIONS
	
	*************************************************************************/

	/**
	*
	*	Generates a ten characters Alphanumeric string.
	*	This key will be used to store photos.
	*
	**/
	private function generateKey(){
		do{
			$key = sha1(microtime(true).mt_rand(10000,90000));
			$unicityTest = $this->Photo->findBySecretkey($key);		
		}while(!empty($unicityTest));
		
		//$this->out('[SUCCESS] The Generated Key is: '.substr($key,0,10));
		return substr($key,0,20);
	}
	
	/**
	*
	*	Generates the photos in the right format. (Size and Resolution)
	*
	**/
	private function generatePhotos($file, $folder, $key = null, $size = null , $resolution = null){
		$im = new Imagick(); 
		if($size!=null && $resolution != null){
			$im->readImage($file->path);
			$im->setImageResolution($resolution,$resolution); 
			$im->resizeImage ( 0, $size ,Imagick::FILTER_LANCZOS,1 );
		}else{
			$im->readImage($file->path);
		}
		if($key == null){
			$key = $file->name();
		}
		$im->writeImage($folder->pwd().'/'.$key.'.jpg');
		//$this->out('[SUCCESS] Copied '.$key.'.jpg'.' Size: '.$size.'px Resolution: '.$resolution.' dpi');
	}
	
	
	/**
	*
	*	Create a Thumbnail for the photo
	*
	**/
	private function createThumbnail($file,$key){
		$im = new Imagick($file->path);
		
		$im->cropThumbnailImage(120,120);
		$im->writeImage('C:\\\\Users\\\\CCS\\\\Documents\\\\GitHub\\\\photodigme\\\\www\\\\app\\\\webroot\\\\img\\\\assets\\\\120\\\\'.$key.'.jpg');
		//$this->out('[SUCCESS] Thumbnail created.');
	}
	
	/**
	*
	*	Store the photo in database
	*
	**/
	private function storePhotos($file,$key){
		$this->Photo->create();
		$photo = array('secretkey'=>$key,'originalfilename'=>$file->name(),'lastupdate'=>date('Y-m-d H:i:s'));
		if ($this->Photo->save($photo)){
			//$this->out('[SUCCESS] Photo Stored.');
			$entity = array('photo_id'=>$photo_id);
			if($this->Entity->save($entity)){
				//$this->out('[SUCCESS] Photo Stored.');
			}else{
			}
		}else{
			//$this->out('[ERROR] Photo not stored.');
		}
	}
}
