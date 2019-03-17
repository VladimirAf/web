<?php

require_once('gud.php');

$key="";
$comnumber = 0;

if(empty($key) || empty($comnumber)){
	echo "Введите, пожалуйста, ключ и номер своей группы в файле index.php";
	exit();
}

$date = strtotime($_REQUEST['chooseDate'])+20000;
$obj = new apiVK($key,$comnumber,$date);
$result=$obj->getStatistic();

echo 'Мода времени ожидания '.$result[0] .' минут ';
echo ' Среднее время ожидания '.$result[1] .' минут ';
echo print_r($result[2],true);

?>