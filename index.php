<?php
include_once("login.php");
if(isset($_GET['logout'])){
     
    //Simple exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln' style='color:red;'><i><b style='color:blue;'>پیام سیستم:</b> ". $_SESSION['name'] ." از چت روم خارج شد.</i><br></div>");
    fclose($fp);
     
    session_destroy();
    header("Location: index.php"); //Redirect the user
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>چت روم «فعلاً» ساده</title>
<link type="text/css" rel="stylesheet" href="style.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
if(!isset($_SESSION['name'])){
    loginForm();
}
else{
?>
<div id="wrapper">
  <div id="menu">
    <p class="welcome">خوش آمدید، <b><?php echo $_SESSION['name']; ?></b> گرامی؛</p>
    <p class="logout"><a id="exit" href="#">خروج از چت روم</a></p>
    <div style="clear:both"></div>
  </div>
  <div id="chatbox">
    <?php
if(file_exists("log.html") && filesize("log.html") > 0){
    $handle = fopen("log.html", "r");
    $contents = fread($handle, filesize("log.html"));
    fclose($handle);
     
    echo $contents;
}
?>
  </div>
  <form name="message" action="">
    <input name="usermsg" type="text" id="usermsg" size="63" />
    <input name="submitmsg" type="submit"  id="submitmsg" value="بفرس!" />
  </form>
</div>
<br>
<small>&copy; آموزش اختصاصی <a href="http://www.learn-net.ir"><strong>انجمن ایرانی ها</strong></a></small> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 
<script type="text/javascript">
	// jQuery Document
	$(document).ready(function(){
	});
	
	// jQuery Document
	$(document).ready(function(){
		//If user wants to end session
		$("#exit").click(function(){
			var exit = confirm("واقعاً می خواهید از چت روم خارج شوید؟");
			if(exit==true){window.location = 'index.php?logout=true';}		
		});
	});

	//If user submits the form
	$("#submitmsg").click(function(){	
		var clientmsg = $("#usermsg").val();
		$.post("post.php", {text: clientmsg});				
		$("#usermsg").attr("value", "");
		return false;
	});
	
	//Load the file containing the chat log
	function loadLog(){		

		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div				
		  	},
		});
	}

	//Load the file containing the chat log
	function loadLog(){		
		var oldscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height before the request
		$.ajax({
			url: "log.html",
			cache: false,
			success: function(html){		
				$("#chatbox").html(html); //Insert chat log into the #chatbox div	
				
				//Auto-scroll			
				var newscrollHeight = $("#chatbox").attr("scrollHeight") - 20; //Scroll height after the request
				if(newscrollHeight > oldscrollHeight){
					$("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
				}				
		  	},
		});
	}
		setInterval (loadLog, 2500);	//Reload file every 2500s ms
</script>
<?php
}
?>
</body>
</html>
