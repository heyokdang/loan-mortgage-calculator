<?php
error_reporting(0);
$cars = array("Volvo", "BMW", "Toyota", "Dio Bee", "Len See");

foreach ($cars as $key => $value){
	echo "<br>";
	echo $cars[$key];
	// if ($cars[$key]) {
	// 	# code...
	// }
	// don't use extra payment of this month
	if ($value == "Toyota") {
		# code...
		unset($cars[$key]);
	}
	
}

echo "<br>";
echo "<br>";
echo "<br>";

foreach ($cars as $key => $value){
	echo "<br>";
	echo $cars[$key];
}

echo "<br>";
echo "<br>";
echo "<br>";

$numb = array(2,3,4,5,6);

$a = 10 + $numb[2];
echo $a;
echo "<br>";
$a += $numb[10];
echo "a + numb[10]: " . $a;

if($numb[10]){


}else{
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "<br>";
	echo "string";
}

$fff = -10;

if($fff){
	echo "<br<br>fff1111";
}else{
	echo "<br<br>fff2222";
}

echo "<br><br><br><br>";
$x = array(5,6,7,8,9,5,7,3,5);
$y = array();
var_dump($x);
// unique datetime
// for ($i=0; $i < count($x); $i++) {
// 	$y[$i] = $x[$i];
//   for ($j=$i+1; $j < count($x); $j++) {
//     if ($x[$i] == $x[$j]) {
//     	$y[$i] +=$x[$j];
//     	unset($x[$j]);
//     }
//   }
// }
foreach ($x as $key => $value) {
	foreach ($x as $key1 => $value1) {
		echo "\n";
		echo "$key   ---   $key1";
	}
}
var_dump($x);
var_dump($y);

