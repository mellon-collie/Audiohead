<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Searching GUI </title>
        <style media="screen">
            body
            {
                background-color: #222;
            }
            div
            {
                position: absolute;
                top: 500px;
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
            button
            {
                top: 200px;
                position: absolute;
                cursor: crosshair;
                text-align: center;
                width: 25%;
                margin: 0 auto;
                background: #222;
                padding: 20px;
                color: #185875;
                border-radius: 20px;
                font-size: 30px;
                font-family: Neuropol X;
                background-color: #1F2739;
                text-shadow: 0px 2px 3px #171717;
                -webkit-box-shadow: 0px 2px 3px #555;
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
            p
            {
                position:relative;
                bottom:320px;
            }
            #song
            {
                left: 6.25%;
            }
            #artist
            {
                left: 37.5%;
            }
            #album
            {
                left: 68.75%;
            }
            #player
            {
                display: none;
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
    </head>
    <body>
        
        <audio id = "music"> </audio>
        <button id="song" type="button" name="songbutton" value = "Enter Song Name: " onclick="playmenu(event)">Search By Song</button>
        <button id="artist" type="button" name="artistbutton" value = "Enter Artist Name: " onclick="playmenu(event)">Search By Artist</button>
        <button id="album" type="button" name="albumbutton" value = "Enter Album Name: " onclick="playmenu(event)">Search By Album</button>
        <div id="player" style="position: relative; left:0%">
            <br><br>
            <input type="text" name="searchbox" id = "searchbox" placeholder="Search...">    
            <img src = "search.png" id = "search" style="position: absolute; right:17%; width: 50px;">
            <br><br>
            <img style="position: absolute; left:3%" src = "prevbutton.png" onclick = "previousSong()">
            <img style="position: absolute; left:23%" src = "playbutton.png" onclick = "play()">
            <img style="position: absolute; left:43%" src = "pausebutton.ico" onclick = "pause()">
            <img style="position: absolute; left:63%" src = "stopbutton.png" onclick = "pause()">
            <img style="position: absolute; left:83%" src = "nextbutton.png" onclick = "nextSong()">
        </div>

        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript">
        var para = document.createElement("p");
        var i = 0;
        var k = 0;
        var currenttarg = "";

        var searchicon = document.querySelector("#search");
        searchicon.addEventListener("click", getSong, false);
        //searchicon.addEventListener("click", getAlbum, false);
        

        function getSong()
        {
            if(currenttarg.id == "song")
            {
                alert(document.getElementById("searchbox").value)
                $.ajax({
                type:'post',
                url:"getSong.php",
                data:{"song":document.getElementById("searchbox").value+".mp3"},
                success:function(details) {
                    if(details.includes("Song Not Found"))
                    {
                        alert(details)
                    }
                    else
                    {
                        songName = details.split("\n")[0]
                        albumName = details.split("\n")[1]
                        artistName = details.split("\n")[2]
                        alert(songName)
                        ele = document.getElementById("music")
                        ele.setAttribute("src","Music/"+artistName+"/"+albumName+"/"+songName)
                        ele.setAttribute("type","audio/mp3")
                        ele.load()
                    }
                    
                    }

                });
            }


            if(currenttarg.id == "album")
            {
                alert(document.getElementById("searchbox").value)
                $.ajax({
                    type:'post',
                    url:"getAlbum.php",
                    data:{"album":document.getElementById("searchbox").value},
                    success:function(details) {
                        if(details.includes("Album Not Found"))
                        {
                            alert(details)
                        }
                        else
                        {
                            songs = details.split("\n")
                            alert(songs)
                            if(songs.length>0)
                            {
                                playAlbum()
                            }
                        }
                        
                    }
                })
            }

            if(currenttarg.id == "artist")
            {
                alert(document.getElementById("searchbox").value)
                $.ajax({
                    type:'post',
                    url:"getArtist.php",
                    data:{"artist":document.getElementById("searchbox").value},
                    success:function(details) {
                        if(details.includes("Artist Not Found"))
                        {
                            alert(details)
                        }
                        else
                        {
                            songs = details.split("\n")
                            alert(songs)
                            if(songs.length>0)
                            {
                                playArtist()
                            }
                        }
                       
                    }
                })
            }



        }
       
        function playmenu(event)
        {
            var a = document.querySelector("#player")
            if(i==1)
            {
                a.removeChild(a.lastChild);
            }
            if(i==0)
                i = 1;
            a.style.display = "block";
            currenttarg = event.currentTarget;/*
            if(event.currentTarget.id == "song")
            {
                var ele = document.getElementById("search")
                ele.addEventListener("click","getSong")
            }
            else if(event.currentTarget.id == "album")
            {
                var ele = document.getElementById("search")
                ele.addEventListener("click","getAlbum")
            }*/
            para.innerHTML = event.currentTarget.value;
            a.appendChild(para);
        }
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
            k--;
            if(album == false)
            {
                ele.setAttribute("src","Music1/"+artist+"/"+songs[k])
                alert("Music1/"+artist+"/"+songs[k])
                ele.setAttribute("type","audio/mp3")
                ele.load()
                ele.play()
            }
            else
            {
                ele = document.getElementById("music")
                ele.setAttribute("src","Music/"+artist+"/"+album+"/"+songs[k])
                alert("Music/"+artist+"/"+album+"/"+songs[k])
                ele.setAttribute("type","audio/mp3")
                ele.load()
                ele.play()
            }
           
        }
        function nextSong()
        {
            ele = document.getElementById("music")
            if(album == false)
            {
                ele.setAttribute("src","Music1/"+artist+"/"+songs[k])
                alert("Music1/"+artist+"/"+songs[k])
                ele.setAttribute("type","audio/mp3")
                ele.load()
                ele.play()
                k++
            }
            else
            {
                ele.setAttribute("src","Music/"+artist+"/"+album+"/"+songs[k])
                alert("Music/"+artist+"/"+album+"/"+songs[k])
                ele.setAttribute("type","audio/mp3")
                ele.load()
                ele.play()
                k++
            }
            
        }
        function playAlbum()
        {
            artist = songs[0]
            album = songs[1]
            k = 2;
            nextSong(2)
        }

        function playArtist()
        {
            artist = songs[0]
            album = false
            k = 2
            nextSong(2)
        }

    </script>

    </body>

</html>


    
</script>
</body>
</html>