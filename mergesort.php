<?php
class Merge
{
	function __construct()
	{
		$a = $this->init_array();
		$this->a = $a;
		echo "Original Array : ";
		echo implode(', ',$a)."\n";
		$this->aux = null;
		$this->sort(0, sizeof($a)-1);
	}

	private function init_array(){
		$n = 100;
		$init_array = array();
		for ($i=0; $i < $n ; $i++) { 
			$init_array[] = rand(1,1000);
		}
		return $init_array;
	}

	public function sort($lo, $hi){
		if( $hi <= $lo ){
			return false;
		}
		$mid = $lo + intval(floor(($hi - $lo) / 2));
		$this->sort($lo, $mid);
		$this->sort($mid + 1, $hi);
		$this->merge($lo, $mid, $hi);
	}

	private function merge($lo, $mid, $hi){
		for ($k=$lo ; $k <= $hi ; $k++) { 
			$this->aux[$k] = $this->a[$k];
		}
		$i = $lo;
		$j = $mid + 1; 
		for ($k = $lo ; $k <= $hi ; $k ++) { 
			if( $i > $mid ){
				$this->a[$k] = $this->aux[$j++];
			}else if( $j > $hi ){
				$this->a[$k] = $this->aux[$i++];
			}else if(  $this->aux[$j] < $this->aux[$i] ){
				$this->a[$k] = $this->aux[$j++];
			}else{
				$this->a[$k] = $this->aux[$i++];
			}
		}
	}
}
// ini_set('memory_limit', '2560M');
$time_start = microtime(true);
$merge = new Merge();
echo "Sorted Array   : ";
echo implode(', ',$merge->a)."\n";
$time_end = microtime(true);
$time = $time_end - $time_start;
echo $time."\n";
