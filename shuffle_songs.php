<?php
	shell_exec("gcc shuffle.c");
	$output = shell_exec("./a.out");
	echo $output;
?>