<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		//echo $_POST["playlist"];
		$fp = fopen("tempPlaylist.txt","w+");
		fwrite($fp,$_POST["playlist"]);
		shell_exec("gcc create_playlist.c");
		$output = shell_exec("./a.out");
		echo $output;
	}
?>