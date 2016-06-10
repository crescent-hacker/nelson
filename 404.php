<?php 
$qs = $_SERVER['QUERY_STRING']; 
$_SERVER['REQUEST_URI'] = substr($qs, strpos($qs, ‘:80′)+3); $_SERVER['PATH_INFO'] = $_SERVER['REQUEST_URI']; include(‘index.php’); ?>