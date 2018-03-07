<?php
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
	</style>
</head>
<body>

<script type="text/javascript">
	var j = 0
	var songs = []	
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
	function playCurrentShuffle()
		{
			j = 1
			nextSongShuffle()
		}

	function nextSongShuffle()
	{
		songName = songs[j].split(";")[0]
		albumName = songs[j].split(";")[1]
		artistName = songs[j].split(";")[2]
		j++;
		ele = document.getElementById("music")
		ele.setAttribute("src","Music/"+artistName+"/"+albumName+"/"+songName)
		alert("Music/"+artistName+"/"+albumName+"/"+songName)
		ele.setAttribute("type","audio/mp3")
		ele.load()
		ele.play()
	}
	function previousSongShuffle()
	{
		j--
		songName = songs[j].split(";")[0]
		albumName = songs[j].split(";")[1]
		artistName = songs[j].split(";")[2]
		ele = document.getElementById("music")
		ele.setAttribute("src","Music/"+artistName+"/"+albumName+"/"+songName)
		alert("Music/"+artistName+"/"+albumName+"/"+songName)
		ele.setAttribute("type","audio/mp3")
		ele.load()
		ele.play()
	}
		
	function shuffle()
	{
	$.ajax({
		type:'post',
		url:"shuffle_songs.php",
		success:function(details){
			console.log(details)
			songs = details.split("\n")
				alert(songs)
				if(songs.length>0)
				{
					playCurrentShuffle()
				}
			}
			
		})
	}

</script>
	<audio id = "music"> </audio>
	 <div id="player" style="position: relative; left:0%">
        <br><br>
        <input type="text" name="searchbox" id = "searchbox" placeholder="Search..">    
         <img src = "search.png" id = "search" style="position: absolute; right:17%; width: 50px;" onclick="shuffle()">
            <br><br>
            <img style="position: absolute; left:3%" src = "prevbutton.png" onclick = "previousSongShuffle()">
            <img style="position: absolute; left:23%" src = "playbutton.png" onclick = "play()">
            <img style="position: absolute; left:43%" src = "pausebutton.ico" onclick = "pause()">
            <img style="position: absolute; left:63%" src = "stopbutton.png" onclick = "pause()">
            <img style="position: absolute; left:83%" src = "nextbutton.png" onclick = "nextSongShuffle()">
        </div>
</body>
</html>