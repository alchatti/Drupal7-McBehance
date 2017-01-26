<?php
namespace Behance;

class FileIO {
    /**
     * @var string
     */
	protected $_destination;
	
	public function __construct($fileName, $loc = 'public') {
		if(!is_dir($loc ."://mc_behance")){
			mkdir($loc ."://mc_behance", 0700);	
		}
		$this->_destination = $loc .'://mc_behance/'. $fileName . '.json';
	}
	
	public function write($data){
		 $fp = fopen($this->_destination, 'w');
		 fwrite($fp, json_encode($data));
		 fclose($fp);
	}
	
	public function read(){
		//$fp = fopen($this->_destination, 'r');
		$result = json_decode(file_get_contents($this->_destination,true));
		return $result;
	}
	
	public function cached($seconds){
		if (file_exists($this->_destination)) {
		    if(time()-filemtime($this->_destination) < $seconds){
		    	return true;
		    }
		}
		return false;
	} 
	
	public function delete(){
		if (file_exists($this->_destination)) {
			unlink($this->_destination);
		}
	}
}