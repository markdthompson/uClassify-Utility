<?php
/**
* This a lightweight uClassify RESTish API php wrapper class
*
* Encapsulates a subset of the uClassify URL RESTish API 
* see http://uclassify.com/UrlApiDocumentation.aspx 
*
* Be sure to sign up with uClassify to get your read key 
* and replace '***YOUR_READ_KEY***' with your own read key.
*
* @author Mark Thompson <mark@smithandthompson.net>
*
**/

class uClassify {
	
	// private properties
	private $baseUrl = 'http://uclassify.com/browse/';
	private $provider = "uClassify";
	private $readkey = 'vhSVEuFSAZXrYxkCj3oxXN0TI+E=';//***YOUR_READ_KEY***';
	private $removeHTML = 1;
	private $encoding = 'json';
	private $version = '1.01';
	private $classifier = "topics"; // default to topics command
	private $classifier_whitelist = array(	'topics'=>'uClassify',
											'society topics'=>'uClassify',
											'home topics'=>'uClassify',
											'art topics'=>'uClassify',
											'game topics'=>'uClassify',
											'health topics'=>'uClassify',
											'computer topics'=>'uClassify',
											'business topics'=>'uClassify',
											'recreation topics'=>'uClassify',
											'sport topics'=>'uClassify',
											'science topics'=>'uClassify',
											'text language'=>'uClassify',
											'sentiment'=>'uClassify',
											'ageanalyzer'=>'uClassify',
											'genderanalyzer_v5'=>'uClassify',
											'classics'=>'uClassify',
											'mood'=>'prfekt',
											'tonality'=>'prfekt',
											'myers briggs judging function'=>'prfekt',
											'myers briggs lifestyle'=>'prfekt',
											'myers briggs attitude'=>'prfekt',
											'myers briggs perceiving function'=>'prfekt');
	
	// Class methods
    public function __construct()  {  
    	//echo 'The class "', __CLASS__, '" was initiated!<br />';
    }  
	
    public function __destruct() { 
    	//echo 'The class "', __CLASS__, '" was destroyed.<br />';
    }  
    
    public function __toString() {
    	return implode(', ', get_object_vars($this));
    }
	
    // Property accessors
    
    // set removeHTML
	public function setRemoveHTML($trueOrFalse) {
		if($trueOrFalse){
			$this->removeHTML = 1;
		} else {
			$this->removeHTML = 0;
		}
		return $this->removeHTML;
	}
	
	// get removeHTML
	public function getRemoveHTML() {
		return $this->removeHTML;
	}
	
	// set encoding
	public function setEncoding($newEncoding) {
		if($newEncoding == 'xml' || $newEncoding == 'json'){
			$this->removeHTML = $newEncoding;
			return 0;
		} else {
			return -1;
		}
	}
	
	// get encoding
	public function getEncoding() {
		return $this->Encoding;
	}
	
	//set the classifier
	public function setClassifier($c){
		if(array_key_exists(strtolower($c),$this->classifier_whitelist)){
			$this->classifier = $c;
			$this->provider = $this->classifier_whitelist[$c];
			return 0;
		} else {
			return -1;
		}
	}
	
	// get the current classifier
	public function getClassifier(){
		return $this->classifier;	
	}
	
	// classify a URL & return the scored classification
	public function classifyUrl($url) {
		// assemble the query string
		$qs = $this->baseUrl.$this->provider."/".str_replace(' ','%20',$this->classifier).'/ClassifyUrl/?readkey='.urlencode($this->readkey).
				'&url='.urlencode($url).'&removeHtml='.$this->removeHTML.'&output='.$this->encoding."&version=".$this->version;
		
		// instantiate cUrl
		$curl = curl_init($qs);
		
		// set options
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		
		// execute, close & return result
		$data = curl_exec($curl);
		
		curl_close($curl);
		
		return $data;
	}
	
	// classify some text & return the scored classification
	public function classifyText($txt) {
		// assemble the query string
		$qs = $this->baseUrl.$this->provider."/".ucwords($this->classifier).'/ClassifyText/?readkey='.urlencode($this->readkey).
					'&text='.urlencode($url).'&removeHtml='.$this->removeHTML.'&output='.$this->encoding."&version=".$this->version;
	
		// instantiate cUrl
		$curl = curl_init($qs);
	
		// set options
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, 0);
	
		// execute, close & return result
		$data = curl_exec($curl);
	
		curl_close($curl);
		
		return $data;
	}
}
?>