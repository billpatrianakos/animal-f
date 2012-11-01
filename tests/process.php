<?php

$data = $_POST['contents'];


$file = 'file.html';
// Open the file to get existing content
$current = file_get_contents($file);
// Append a new person to the file
$current .= $data . "\n";
// Write the contents back to the file
file_put_contents($file, $current);

/*
$myFile = "file.html";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $data . "\n";
fwrite($fh, $stringData);
fclose($fh);
*/
echo "Success. <a href='file.html'>See file contents</a>";

?>