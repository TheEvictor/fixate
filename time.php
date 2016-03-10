<?php
require_once('timer.php');
?>

<html>
<head>
<script>
function move() {
    var elem = document.getElementById("myBar"); 
    var width = 1;
    var id = setInterval(frame, 10);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++; 
            elem.style.width = width + '%'; 
        }
    }
}
</script>
<style type="text/css">
#myProgress {
    position: relative;
    width: 100%;
    height: 30px;
    background-color: grey;
}
#myBar {
    position: absolute;
    width: 1%;
    height: 100%;
    background-color: blue;
}
</style>
</head>
<body onload="move()">
<span id="timer"></span>

</br></br>
<div id="myProgress">
    <div id="myBar"></div>
</div>

</body>
</html>

