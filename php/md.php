<?php 
   include "Parsedown.php";
   
   header('Content-Type: text/html');
   
   $requested = rawurldecode( $_SERVER['REQUEST_URI'] );
   $lang="";
   if (strpos($requested, "_de.md") !==false) $lang="_de";
   if (strpos($requested, "_zh.md") !==false) $lang="_zh";
   if (strpos($requested, "_fr.md") !==false) $lang="_fr";
   
   $index     = file_get_contents("../index$lang.html");
   $md_source = $_SERVER['DOCUMENT_ROOT'] . $requested;
   if ( !file_exists( $md_source ) ) 
       $md_source = "../md/" . end(explode( '/', $requested ));
   else {
       // rewrite relative links if not on the same level as index.html
       $index = str_replace("href=\"css/","href=\"../css/",$index);
       $index = str_replace("href=\"js/","href=\"../js/",$index);
       $index = str_replace("src=\"js/","src=\"../js/",$index);
       $index = str_replace("src=\"img/","src=\"../img/",$index);
       $index = str_replace("href=\"index.html","src=\"../index.html",$index);
       $index = str_replace("href=\"faq.md","src=\"../faq.md",$index);
   }
       
   // write header
   echo substr($index, 0, strpos( $index, "<!-- content_start -->"));
   
   ?>
 		<!-- this is bad, I know -->
		<style type="text/css">
			ul {
				font-size:16px; 
				margin-left:20px;
				line-height: 35px;
			}
			.article-body li {
            margin-left: 20px;
         }

			.article-body p {
				margin-bottom: 14px;
			}

			.article-body p.lead {
				margin-top: 50px;
				margin-bottom: 20px;
			}
         
         .article-body p:first-child.lead {
				margin-top: 0px;
			}
         
         .article-body ul {
           list-style-type: disc;
         }

		</style>
   <?php
   
   // convert md to html
   $pd = new Parsedown();
   $html = $pd->text(file_get_contents($md_source));
   $header = ""; $hc = 0; $title =""; $pre = ""; $post = ""; $h = 0;
   
   // add target to links, so they open in a new window
   $html = str_replace  ( "<a href=" ,"<a target=\"_blank\" href=" ,$html);

   // find all blockqoute before the first h2 and divide them into pre & post depending if the before or after the h1 appear
   $html = preg_replace_callback ( "/<(blockquote|h1|h2)>(.*?)<\/(blockquote|h1|h2)>/s" , function ($match) use (&$pre,&$post,&$h)  {
         if ($match[1]=="h1")       $h=1;
         else if ($match[1]=="h2")  $h=2;
         else if ($h==0) {
            $pre = $pre . preg_replace ( "/<p>(.*?)<\/p>/s" ,  '${1}' ,$match[2])."<br/>";
            return "";
         }
         else if ($h==1) {
            $post = $post . preg_replace ( "/<p>(.*?)<\/p>/s" ,  '${1}' ,$match[2])."<br/>";
            return "";
         }
         return  $match[0];
    }, $html );

   // remove the first h1-title in order to put them as part of the header
   $html = preg_replace_callback ( "(<h1>(.*?)</h1>)" , function ($match) use (&$title)  {
      if (!$title) {
        $title = $match[1];
        return "";
      }
      else
        return $match[0];
   }, $html );
   
   // replace all h3 with p.lead
   $html = preg_replace ( "(<h3>(.*?)</h3>)" ,  '<p class="lead">${1}</p>' ,$html);

   // create sections for all h2
   $html = preg_replace_callback ( "(<h2>(.*?)</h2>)" , function ($match) use (&$hc,&$header)  {
   	$hc=$hc+1;
   	$header = $header. "<li><a href=\"#a$hc\">".$match[1]."</a></li>";
      $contentStart = '<section class="article-single"><div class="container"><div class="row"><div class="col-sm-12"><div class="article-body">';
      $contentEnd = $hc>1 ? '</div></div></div></section>' : '';
   	return "$contentEnd <a name=\"a$hc\"></a><section class='strip bg-secondary-3'><div class='container'><div class='row clearfix'><div class='col-sm-6 col-xs-12 pull-left'><h3 class=\"text-white\">".$match[1]."</h3></div></div></div></section>$contentStart";
   }, $html );
   
   // close the last section
   if ($hc>0) $html = "$html </div></div></div></section>";
   
   
   ?>
         <!-- ****************************************** -->
			<!-- *******          HEADER           ******** -->
			<!-- ****************************************** -->

			<header class="page-header">
				<div class="background-image-holder parallax-background">
					<img class="background-image" alt="Background Image" src="img/hero4.jpg">
				</div>
				
				<div class="container">
					<div class="row">
						<div class="col-sm-12">
							<span class="text-white alt-font"><?php echo $pre; ?></span>
							<h1 class="text-white"><?php echo $title; ?></h1>
							<p class="text-white lead">
								<?php echo $post; ?><br><br>
								<ul style="font-size:20px; line-height: 200%;">									
									<?php echo $header; ?> 
								</ul>
							</p>
						</div>
					</div>
				</div>
			</header>



   <?php
   
   // write the md-content
   echo $html;
   
   // write the footer
   echo substr($index, strpos( $index, "<!-- content_end -->"));
   
 ?>
