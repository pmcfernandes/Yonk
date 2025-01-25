<?php

/*
  * Loads on Elementor's frontend editor 
  * Added by kishorchand
  * Use child theme's function.php or code snippets plugin for better code management.  
*/
function Yonk_remove_elementor_nag() {
	?>
      <style id="remove-nag">
          .elementor-control-media__promotions.elementor-descriptor,
          .elementor-control-media__promotions.elementor-descriptor[role="alert"]{
              display: none!important;
      }  
/*  
  * if you're not using AI feature and keep annoys you, use this CSS rule to hide AI button
*/   
       .e-ai-button{
           display: none!important;
        }
  	


.css-1ncn4io,
.MuiBox-root .css-hpgf8j{
  pointer-events: none!Important;
  opacity: 0!important;
  display: none!important;
}
 
  
      </style>
	<?php
    } 

add_action( 'elementor/editor/before_enqueue_styles', 'Yonk_remove_elementor_nag' );


/* 
  * Hide Elementor image optimization ads when choosing the post's featured image on the backend
  * UPDATE: 20/06/24 Hide Elementor image optimization ads on Media Library, if closing the "x" is not enough.
*/ 
function Yonk_hide_elementor_nag_admin() {
	?>
      <style id="remove-nag">	
      /*
       * Hide Elementor image optimization ads when choosing the post's featured image on the backend, frontend       
      */      
        .elementor-control-notice.elementor-control-notice-type-info,  
        .e-notice--cta,
  	.e-featured-image-ai,
  	.e-image-ai-insert-media,
        .e-excerpt-ai{
              display: none!important;
      } 
  

/* 
 * Hide the first element with class "css-1hboo5q" and all elements with class "css-1hboo5q"  
 * You will get Image optimizer ads on Elementor > Home > Expand your design toolkit
*/		  
.css-1hboo5q:first-child,
.css-1hboo5q {
    opacity: 0!important; /* Force opacity to 0, ignoring inheritance */
    height: 258.36px;
    width: 401.9px;
    pointer-events: none; /* Disable pointer interactions */
    cursor: none; /* Remove cursor display */
    position: relative; /* Set positioning relative to its container */
    z-index: 1; /* Set stacking order to be above other elements */
}
  
/* 
 * Hide the "Generate with Elementor AI" button in Media Library
*/   
#e-image-ai-attachment-details, 
#e-image-ai-media-library {
      opacity: 0!important;/* Force opacity to 0, ignoring inheritance */
      pointer-events: none;/* Disable pointer interactions */
}
      </style>
	<?php
 } 

add_action( 'admin_head', 'Yonk_hide_elementor_nag_admin' );