<?php 

//  This is the rough tets page to calculate the caculator functionality in core php.
//  BODMAS rule applied as logic
// 1. get the input as string 
// 2. converted the string to array with numbers and operators
// 3. create an operators array which contains basic operatos like , array("*"=>"multiplication" ...)
// 4. In a loop to identify each operators and its pre and post value of that operator from the result array based 			on the operator array.
// 5. make arithematic operation based on the operator with its pre and post value 
// 6. replace the the result to existing array.
// 7. recursively do the same until the array length become 1 as the final result.



//  get the input to calculate eg: 10/2+5
$input = $_POST['input_calc'];
// formatted the entire string to numbers and operators
$formatted = implode(' ',preg_split("/(?<=[\d.])(?=[^\d.])|(?<=[^\d.])(?=[\d.])/", $input)); 
// converted the string to array with  numbers and operators
$result = explode (" ", $formatted);

echo "<pre>";
print_r($result);


function calculate($result){
		// $formatted = implode(' ',str_split($input)); 
		// $result = explode (" ", $formatted);	
		$operators = array("/"=>"division","*"=>"multiplication","+"=>"add","-"=>"subtract");
		foreach ($operators as $key => $fun) {

			$index = array_search($key, $result);
			if($index){
					// echo "<br>". $index." ".$key." ".$fun;
					$preVal = $result[$index-1];
					$postVal = $result[$index+1];

					$res = $fun($preVal,$postVal);
					unset($result[$index-1]);
					unset($result[$index]);
					unset($result[$index+1]);
					$result[$index-1] = $res;
					ksort($result);
					$result = array_values($result);

					if(count($result)==1){
						echo "-----------".$result[0];exit;
					}else{
						print_r($result);
						calculate($result);
					}


			}






		}
}		
// $input = substr_replace($input, 7, 2, 1);


calculate($result);


function division($a,$b){
	// echo $a.$b;exit;
	return $a/$b;
}

function multiplication($a,$b){
	return $a*$b;
}

function subtract($a,$b){ return $a-$b; }

function add($a,$b){
	return $a+$b;
}


 ?>