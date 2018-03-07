<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$albumName = $_POST["album"];
		shell_exec("gcc search.c");
		$output = shell_exec("./a.out albums ".$albumName);
		echo $output;
	}
?>