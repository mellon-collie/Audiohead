<?php
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		div
            {
                position: absolute;
                top: 100px;
                left: 400px;
                text-align: center;
            	width: 1000px;
                height: 300px;
                margin: 0 auto;
                background: #222;
                padding: 50px;
                font-family: Ubuntu;
            	font-size: 30px;
                color: #555;
                text-shadow: 0px 2px 3px #171717;
            	-webkit-box-shadow: 0px 0px 5px #555;
            	-moz-box-shadow: 0px 2px 3px #555;
            	-webkit-border-radius: 10px;
            	-moz-border-radius: 10px;
            }
            div input
            {
                padding: 10px;
                background: #222;
                font-family: Ubuntu;
                text-align: left;
                font-size: 20px;
                color: #555;
            	-webkit-box-shadow: 0px 0px 5px #555;
            	-moz-box-shadow: 0px 2px 3px #555;
            	-webkit-border-radius: 10px;
            	-moz-border-radius: 10px;
            }
            div img
            {
                width: 150px;
                height: auto;
            }
            div a img
            {
            	width: 150px;
                height: auto;
            }
            p
            {
                position:relative;
                bottom:320px;
            }  
            input[type=text] {
                width: 60%;
                box-sizing: border-box;
                border: 2px solid #ccc;
                border-radius: 4px;
                color: White;
                font-size: 16px;
                background-color: Black;
                background-image: search.jpg;
                background-position: 10px 10px; 
                background-repeat: no-repeat;
                padding: 12px 20px 12px 40px;
                -webkit-transition: width 0.4s ease-in-out;
                transition: width 0.4s ease-in-out;
            }
	</style>
	<title></title>
</head>
<body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
	function play()
		{
			ele = document.getElementById("music")
			ele.play()
		}
		function pause()
		{
			ele = document.getElementById("music")
			ele.pause()
		}
		function previousSong()
		{
			i--;
			ele = document.getElementById("music")
			ele.setAttribute("src","Music/"+artist+"/"+album+"/"+songs[i])
			alert("Music/"+artist+"/"+album+"/"+songs[i])
			ele.setAttribute("type","audio/mp3")
			ele.load()
			ele.play()
		}
		function nextSong()
		{
			ele = document.getElementById("music")
			ele.setAttribute("src","Music/"+artist+"/"+album+"/"+songs[i])
			alert("Music/"+artist+"/"+album+"/"+songs[i])
			ele.setAttribute("type","audio/mp3")
			ele.load()
			ele.play()
			i++
		}
		function play_playlist()
		{
			album = songs[0]
			artist = songs[1]
			i = 2;
			nextSong(2)
		}

	function loadPlaylist()
	{
		
		alert(document.querySelector("input").value)
		$.ajax({
			type:'post',
			url:"play_playlist.php",
			data:{"playlist":document.querySelector("input").value},
			success:function(details) {
				temp_songs = details.split("\n")
				alert(songs)
				for(i = 0;i<temp_songs.length;i++)
				{
					songs[i] = temp_songs[i].split(";")[0]
				}
				if(songs.length>0)
				{
					play_playlist()
				}
			}
		})
	}
</script>
	<audio id = "music"> </audio>
	<div id="player" style="position: relative; left:0%">
        <br><br>
        <input type="text" name="searchbox" id = "searchbox" placeholder="Search..">    
         <img src = "search.png" id = "search" style="position: absolute; right:17%; width: 50px;" onclick="loadPlaylist()">
            <br><br>
            <img style="position: absolute; left:3%" src = "prevbutton.png" onclick = "previousSong()">
            <img style="position: absolute; left:23%" src = "playbutton.png" onclick = "play()">
            <img style="position: absolute; left:43%" src = "pausebutton.ico" onclick = "pause()">
            <img style="position: absolute; left:63%" src = "stopbutton.png" onclick = "pause()">
            <img style="position: absolute; left:83%" src = "nextbutton.png" onclick = "nextSong()">
        </div>
</body>
</html>