<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class PhotoShell extends AppShell {
    var $uses = array('Photo','Entity');
		
	public function main() {
		$toProcess = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\pending');
		$original = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\original');
		$error = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\\\error');
		$x800x72 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\800x72');
		$x800x144 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\800x144');
		$x500x72 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\500x72');
		$x500x144 = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\500x144');
		$thumbnail = new Folder('C:\\Users\\CCS\\Documents\\GitHub\\photodigme\\www\\app\\webroot\\img\\assets\\120');
        
		$files = $toProcess->find('.*\.jpg');
		
		$this->out('There are: '.sizeof($files).' files to process...');
		foreach($files as $file){
			try{
				$this->out('Processing '.$file->name);
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
				
				$this->out('[SUCCESS] Created '.$key);
			}catch(Exception  $e){
				storePhoto($file, $this->error);
				$this->out('[ERROR] Impossible to generate '.$file->name());
			}
		}
    }
	
	public function generateKey(){
		do{
			$key = sha1(microtime(true).mt_rand(10000,90000));
			$unicityTest = $this->Photo->findBySecretkey($key);		
		}while(!empty($unicityTest));
		
		$this->out('[SUCCESS] The Generated Key is: '.substr($key,0,10));
		return substr($key,0,20);
	}
	
	public function generatePhotos($file, $folder, $key = null, $size = null , $resolution = null){
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
		$this->out('[SUCCESS] Copied '.$key.'.jpg'.' Size: '.$size.'px Resolution: '.$resolution.' dpi');
	}
	
	public function createThumbnail($file,$key){
		$im = new Imagick($file->path);
		
		$im->cropThumbnailImage(120,120);
		$im->writeImage('C:\\\\Users\\\\CCS\\\\Documents\\\\GitHub\\\\photodigme\\\\www\\\\app\\\\webroot\\\\img\\\\assets\\\\120\\\\'.$key.'.jpg');
		$this->out('[SUCCESS] Thumbnail created.');
	}
	
	public function storePhotos($file,$key){
		$this->Photo->create();
		$photo = array('secretkey'=>$key,'originalfilename'=>$file->name(),'lastupdate'=>date('Y-m-d H:i:s'));
		if ($this->Photo->save($photo)){
			$this->Entity->create();
			$photo_id = $this->Photo->id;
			$entity = array('photo_id'=>$photo_id);
			if($this->Entity->save($entity)){
				$this->out('[SUCCESS] Photo Stored.');
			}else{
				$this->out('[ERROR] The Entity has not been created');
			}			
		}else{
			$this->out('[ERROR] Photo not stored.');
		}
	}
}
?>