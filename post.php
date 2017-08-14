<?php
session_start();
if(isset($_SESSION['name'])){
    $text = $_POST['text'];
     
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><span class='msgtime'>".date("g:i A")."</span><br><b>".$_SESSION['name']." میگه</b>: ".stripslashes(htmlspecialchars($text)). "<br></div>");
    fclose($fp);
}
?>
