<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$songName = $_POST["song"];
		shell_exec("gcc search.c");
		$output = shell_exec("./a.out songs ".$songName);
		if(strcmp($output,"Song Not Found") == 0)
		{
			echo $output;
		}
		else
		{
			$song = strtok($output,";");
			$album = strtok(NULL,";");
			$artist = strtok(NULL,";");
			echo $song." ".$album." ",$artist;
		}
		
	}
?>