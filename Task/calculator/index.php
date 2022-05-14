<?php 
require_once('calculator.php');
if(isset($_POST['submit'])){
	$input = $_POST['input_calc'];
	$mycalc = new Calculator($input); 
	$output = $mycalc->calculate();
}



 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calculator</title>
</head>
<body>

<form method="post">
<input type="text" name="input_calc" value="<?php echo $_POST['input_calc'];?>">
<button name="submit">=</button>
<?php if(isset($output)){ echo $output;} ?>
</form>

</body>
</html>