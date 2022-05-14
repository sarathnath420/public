<?php 
// 1. get the input as string 
// 2. converted the string to array with numbers and operators
// 3. create an operators array which contains basic operatos like , array("*"=>"multiplication" ...)
// 4. In a loop to identify each operators and its pre and post value of that operator from the result array based 			on the operator array.
// 5. make arithematic operation based on the operator with its pre and post value 
// 6. replace the the result to existing array.
// 7. recursively do the same until the array length become 1 as the final result.

class Calculator {

	private $fval, $sval;
	private $_arr;
	private $output;
	private $operators = array("/"=>"division","*"=>"multiplication","+"=>"add","-"=>"subtract");
	public function __construct( $input ) {
		$formatted = implode(' ',preg_split("/(?<=[\d.])(?=[^\d.])|(?<=[^\d.])(?=[\d.])/", $input)); 
		$result = explode (" ", $formatted);		
		$this->_arr = $result;
		// return $this->calculate();

	}

	public function calculate()
	{
		foreach ($this->operators as $key => $fun) {
			$index = array_search($key, $this->_arr);
			if($index){
				// echo "<br>". $index." ".$key." ".$fun;
				$this->fval = $this->_arr[$index-1];
				$this->sval = $this->_arr[$index+1];
				$res = $this->$fun();			
				unset($this->_arr[$index-1]);
				unset($this->_arr[$index]);
				unset($this->_arr[$index+1]);
				$this->_arr[$index-1] = $res;
				ksort($this->_arr);
				$this->_arr = array_values($this->_arr);

				if(count($this->_arr)==1){
					$this->output = $this->_arr[0];
				} else {
					$this->calculate($this->_arr);
				}
			}
		}

		return $this->output;exit;
	}
	public function add($value='')
	{
		return $this->fval+$this->sval;
	}
	public function subtract($value='')
	{
		return $this->fval-$this->sval;
	}
	public function multiplication($value='')
	{
		return $this->fval*$this->sval;
	}
	public function division($value='')
	{
		return $this->fval/$this->sval;
	}
}


 ?>