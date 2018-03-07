<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title> Playlist GUI </title>
        <style media="screen">
            body
            {
                background-color: #222;
                margin: 70px;
            }
            h1
            {
            	display: block;
                text-decoration: none;
            	font-family: Neuropol X;
                font-size: 100px;
                letter-spacing: -5px;
            	text-align: center;
            	color: #4DC3FA;
                text-shadow: 0px 3px 8px #2a2a2a;
            }
            div input
            {
                padding: 10px;
                background: #222;
                font-family: Ubuntu;
                text-align: left;
                font-size: 50px;
                color: #555;
            	-webkit-box-shadow: 0px 0px 5px #555;
            	-moz-box-shadow: 0px 2px 3px #555;
            	-webkit-border-radius: 10px;
            	-moz-border-radius: 10px;
                width:300px;
            }
              .container
            {
                cursor: crosshair;
                text-align: center;
                overflow: hidden;
                width: 500px;
                margin: 0 auto;
                display: table;
                padding: 0 0 8em 0;
            }
            .container td
            {
                color: #185875;
                border-radius: 20px;
                font-size: 50px;
                padding-bottom: 5%;
                padding-top: 5%;
                padding-left:5%;
                width:250px;
                font-family: Neuropol X;
                background-color: #1F2739;
                font-size: 30px;
                -webkit-box-shadow: 0 2px 2px -2px #0E1119;
                -moz-box-shadow: 0 2px 2px -2px #0E1119;
                box-shadow: 0 2px 2px -2px #0E1119;
            }
            .container tr:hover
            {
                background-color: #464A52;
                -webkit-box-shadow: 0 6px 6px -6px #0E1119;
                -moz-box-shadow: 0 6px 6px -6px #0E1119;
                box-shadow: 0 6px 6px -6px #0E1119;
            }
            .container td:hover
            {
                background-color: #FFF842;
                color: #403E10;
                font-weight: bold;
                box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
                transform: translate3d(6px, -6px, 0);
                transition-delay: 0s;
                transition-duration: 0.4s;
                transition-property: all;
                transition-timing-function: line;
            }
             table
            {
                position: relative;
                text-align: center;
                top: 25px;
            }
            td a
            {
                display: block;
                width: 100%;
                height: 100%;
                text-decoration:none;
                color: #185875;
            }
        </style>
    </head>
    <body>
        <div style="text-align:center;">
            <h1>Creating a Playlist ... </h1>
            <div>
            </div>
            <br><br><br>
            <input type="text" name="details" placeholder="Code:"" style = "width:100px;" id = "code">
            <input type = "text" name = "sname" placeholder = "Song Name: " id = "sname">
            <input type = "text" name = "alname" placeholder= "Album Name: " id = "alname">
            <input type = "text" name = "arname" placeholder = "Artist Name: " id = "arname">
             <table class="container" cellspacing="10px">
                <tbody>
                    <tr>
                        <td><a id = "add">Add Another Song</a></td>
                        <td><a id = "create">Create Playlist</a></td>
                    </tr>
                </tbody>
            </table>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
            <script type="text/javascript">
                var playListString = ""
                var code = document.querySelector("#code");
                var sname = document.querySelector("#sname");
                var alname = document.querySelector("#alname");
                var arname = document.querySelector("#arname");

                var fun = function(event)
                        {
                            playListString = playListString+sname.value.trim()+";";
                            playListString = playListString+alname.value.trim()+";";
                            playListString = playListString + arname.value.trim()+";";
                            playListString = playListString + code.value.trim()+";";
                            playListString = playListString +"\n";
                            code.value = "";
                            arname.value = "";
                            alname.value = "";
                            sname.value = "";

                        }
                function create_playlist()
                {
                    var playListName = prompt("Enter the name of the new playlist")
                    playListString = playListName.trim()+":"+"\n"+playListString
                    alert(playListString)
                    $.ajax({
                    type:'post',
                    url:"playlist.php",
                    data:{"playlist":playListString},
                    success:function(details) {
                        alert(details)
                        }
                    })
                }
                var add = document.querySelector("#add");
                add.addEventListener("click", fun, false);
                var create = document.querySelector("#create");
                create.addEventListener("click",create_playlist,false);

                

            </script>
        </div>
    </body>
</html>
