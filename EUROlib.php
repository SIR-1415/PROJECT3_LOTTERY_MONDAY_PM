<?php
class CKeyGenerator {
	
	const NNUMBERS = 5;
	const NSTARS = 2;
	const MAXNUMBER = 50;
	const MAXSTAR = 11;
	const MINNUMBER = 1;
	const MINSTAR = 1;
	
	 
	public $numbers;
	public $stars;
	
	private $_nn;
	private $_ns;
	private $_minn;
	private $_maxn;
	private $_mins;
	private $_maxs;
	
	public function __construct(
				$nn    = CKeyGenerator::NNUMBERS,
				$ns    = CKeyGenerator::NSTARS, 
				$minn  = CKeyGenerator::MINNUMBER,
				$maxn  = CKeyGenerator::MAXNUMBER,
				$mins  = CKeyGenerator::MINSTAR,
				$maxs  = CKeyGenerator::MAXSTAR) {
					
				$this->_nn    = $nn;
				$this->_ns    = $ns;
				$this->_minn  = $minn;
				$this->_maxn  = $maxn;
				$this->_mins  = $mins;
				$this->_maxs  = $maxs;
				
				$kn =  new CExtractor($this->_minn, $this->_maxn, $this->_nn);
				$ks =  new CExtractor($this->_mins, $this->_maxs, $this->_ns);
				$this->numbers = $kn->generateKey();
				$this->stars = $ks->generateKey();
	}
	
	public function keyAsXML() {
		$XMLKey = new SimpleXMLElement("<key></key>");
		$XNn = $XMLKey->addChild("numbers");
		$XNn->addAttribute("n",$this->_nn);
		foreach ($this->numbers as $keyvalue) {
			$XNn->addChild("ke",$keyvalue);
		}
		
		$XNs = $XMLKey->addChild("stars");
		$XNs->addAttribute("n",$this->_ns);
		foreach ($this->stars as $keyvalue) {
			$XNs->addChild("ke",$keyvalue);
		}
		return $XMLKey->asXML();
	}
	
	public function keyAsJson() {
		return (json_encode($this));
	}
	
}

class CExtractor {
	private $_min;
	private $_max;
	private $_n;
	
	private $_numbers = array();
	private  $_key = array();
	
	public function __construct($min,$max,$n){
		$this->_min = $min;
		$this->_max = $max;
		$this->_n = $n;
	}
	
	private function initKey() {
		$this->_key = array();
	}
	
	private function initNumbers() {
		$this->_numbers = array();
		for($i=0; $i<$this->_max-$this->_min+1; $i++) {
			$this->_numbers[$i] = $i+$this->_min;
		}
	}
	
	public function generateKey() {
		$this->initKey();
		$this->initNumbers();
		for($i=0; $i<$this->_n; $i++) {
			$idx = rand(0,count($this->_numbers)-1);
			$this->_key[] = $this->_numbers[$idx];
			array_splice($this->_numbers,$idx,1);
			}
		sort($this->_key);
		return $this->_key;
	}
	
	public function dumpKey() {
		print_r($this->_key);
	}
	
}
?>
