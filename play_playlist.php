<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$file = $_POST["playlist"].".txt";
		$fp = fopen("trial_playlist.txt","r");
		while(!feof($fp))
		{
			echo fgets($fp);
		}
	}
	
?>