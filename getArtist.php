<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$artistName = $_POST["artist"];
		shell_exec("gcc search.c");
		$output = shell_exec("./a.out artists ".$artistName);
		echo $output;
	}
?>