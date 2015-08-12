<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>slock.it| Home</title>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (Bootstrap's JavaScript plugins) -->
<script src="js/jquery.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- Custom Theme files -->
<meta name="google-site-verification" content="QwKgKR75zOP_7KxJgyAPdNTgML56ndLVddQtUhnxf4k" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="slock ethereum jentzsch etherlock anylock padlock" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,800,300,100,500,700,600,900' rel='stylesheet' type='text/css'>
<!--animated-css-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<link rel="icon" type="image/png" href="images/slock_icon.png">
<script src="js/wow.min.js"></script>
<script>
 new WOW().init();
</script>
<!--/animated-css-->
<!--script-->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<!--/script-->
<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
					$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
				});
			});
</script>
	<link rel="stylesheet" href="css/swipebox.css">
	<script src="js/jquery.swipebox.min.js"></script> 
	    <script type="text/javascript">
			jQuery(function($) {
				$(".swipebox").swipebox();
			});
		</script>
</head>




<body>
<!---->
<div class="banner">
	 <div class="container">
		 <div class="header">	 
			 <div class="logo wow fadeInLeft" data-wow-delay="0.5s">
			 <a href="index.php"><img src="images/logo2.png" alt=""/></a>
			 </div>	
			 <div class="top-menu">
				 <span class="menu"> </span> 
				 <ul>

				 <?php 
				 $arr = array();
				 $content = "";
				 if ($handle = opendir('pages')) {
				 	$pages = array();
				 	while (false !== ($file = readdir($handle))) {
				 		if (strpos($file,".html")!==false) $pages[]=$file;
				 	}
				 	closedir($handle);
				 
				 	sort($pages);
				 }
				 				 
				 for ($i=0;$i<count($pages);$i++) {
				 	$file = $pages[$i];
				 	$lines    = file("pages/$file");
				 	$pathinfo = pathinfo($file);
				 	if (count($lines)>0) { 			// there is content
				 		$first = trim(str_replace("-->","",str_replace("<!--","",$lines[0])));
				 		$id    = str_replace(".html","",$file);
				 		$descr = (strlen($first)>0)?$first: $pathinfo['filename'];
				 		echo "<li><a class=\"scroll\" href=\"#$id\">$descr</a></li>";
				 		$content = $content . "<div id=\"$id\" class=\"$id\">". implode("\n", $lines) . "</div>";
				 	}
				 }
				 	
				 ?>
				 
				 </ul>
			 </div>
			 <div class="clearfix"> </div>
			 </div>
			 <!-- script-for-menu -->
		 <script>					
					$("span.menu").click(function(){
						$(".top-menu ul").slideToggle("slow" , function(){
						});
					});
		 </script>
		 		 <div id="home" class="banner-text wow fadeInUp" data-wow-delay="0.5s">
			 <h1>Slock.it </h1>
			 <h2>If you can lock it, we will let you rent, sell or share it.</h2>
		 </div>
	</div>
</div>


<?php  echo $content; ?>


<div class="get-started page">
	 <div class="container">
		 <h4 class="wow bounceInLeft" data-wow-delay="0.5s">We are Ready to Help You</h4>
		 <h3 class="wow bounceInRight" data-wow-delay="0.5s">Lock Smarter</h3>
	 </div>
</div>
<!---->
<div class="footer">
	 <div class="container">
		 <div class="ftr-logo">
			 <a class="wow bounceIn" data-wow-delay="0.5s" href="index.php"><img src="images/logo2.png" alt=""/></a>
		 </div>
		 <div class="copy-right wow bounceInUp" data-wow-delay="0.5s">
			 <p>Copyright &#169; 2015 slock.it . All Rights Reserved.</p>
			 
		 </div>

	 </div>
</div>
<!---->
<script type="text/javascript">
		$(document).ready(function() {
				/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
				*/
		$().UItoTop({ easingType: 'easeOutQuart' });
});
</script>
<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!----> 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52631731-3', 'auto');
  ga('send', 'pageview');

</script>

 </body>
 </html>
