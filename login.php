<?php
session_start();
 
function loginForm(){
    echo'
    <div id="loginform">
    <form action="index.php" method="post">
        <p>نام خود را برای ادامه وارد نمائید.</p>
        <label for="name">نام:</label>
        <input type="text" name="name" id="name" />
        <input type="submit" name="enter" id="enter" value="ورود!" />
    </form>
    </div>
    ';
}
 
if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">خواهشاً نام خود را وارد کنید.</span>';
    }
}
?>
