<?php

$path = 'upload/';
$fileName = $_GET['cusFile'];
$filePath = $path . $fileName;


if (file_exists($filePath) ) {
   
    header("Content-Disposition: attachment; filename=\"" .     basename($fileName) . "\"");
    header("Content-Length: " . filesize($filePath));
    header("Content-Type: application/octet-stream;");
    readfile($filePath);
}
?>