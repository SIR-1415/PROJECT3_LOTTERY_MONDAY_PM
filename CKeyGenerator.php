<?php

class CKeyGenerator {
	
	public $numbers;
	public $stars;
	
	const MINN = 1;
	const MAXN = 50;
	const MINS = 1;
	const MAXS = 11;
	
	const DNN = 5;
	const DNS = 2;
	
	function __construct($nn = self::DNN, $ns = self::DNS) {
		$this->numbers = array();
		$this->stars = array();
		
		$bag = range(self::MINN, self::MAXN);
		$this->numbers = $this->extractor($bag, $nn);
		
		$bag = range(self::MINS, self::MAXS);
		$this->stars = $this->extractor($bag, $ns);
		
	}
		
	function extractor($bag,$n) {
		$key = array();
		while($n) {
			$random_idx = rand(0,count($bag)-1);
			$extracted = array_splice($bag,$random_idx,1);
			$key[] = $extracted[0];
			$n--;
		}
		sort($key,SORT_NUMERIC);
		return $key;
	}
	
	public function asJSON() {
		echo json_encode($this);
	}
	
	public function asXML() {
		$xmlkey = new SimpleXMLElement("<key/>");
		$xmlnumbers = $xmlkey->addChild("numbers");
		$xmlstars = $xmlkey->addChild("stars");
		
		foreach($this->numbers as $number) {
			$xmlnumbers->addChild("ke",$number);
		}
		
		foreach($this->stars as $star) {
			$xmlstars->addChild("ke",$star);
		}

		echo $xmlkey->asXML();
		
	}
}
