<?php 
   include "Parsedown.php";
   
   header('Content-Type: text/html');
   $requested = rawurldecode( $_SERVER['REQUEST_URI'] );
   $md_source = $_SERVER['DOCUMENT_ROOT'] . $requested;
   if ( !file_exists( $md_source ) )
       $md_source = "../md/" . end(explode( '/', $requested ));
   
   $index = file_get_contents("../index.html");
   echo substr($index, 0, strpos( $index, "<!-- content_start -->"));
   
   $pd = new Parsedown();
   
   echo "<section class=\"inline-image-right\" style=\"background:white\"><div class=\"container\"><div class=\"row\">".$pd->text(file_get_contents($md_source))."</div></div></section>";
        
   echo substr($index, strpos( $index, "<!-- content_end -->"));
   
 ?>
