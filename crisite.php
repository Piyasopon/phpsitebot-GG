<?php

$handle = fopen("php://stdin","r");

echo "What's your name? ";
$line = fgets($handle);
$line = trim($line);

echo "Hello $line!\n";

?>