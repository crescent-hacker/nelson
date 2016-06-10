<?php
/**
 * The template for displaying all pages.
 *
 * @package Tisson
 * @author Muffin group
 * @link http://muffingroup.com
 */

get_header();
$sidebar = mfn_sidebar_classes();
?>
<style type="text/css">
.follower {
    padding: 10px 0 0;
    position: fixed;
    z-index: 99999; 
    right: 0px; 
    top: 300px;    
    opacity: 0.6;
    filter:alpha(opacity=20);   
}
</style>

<!--<div class="follower">
	<div style="width:100%;display:table;height:100px;width:89px;margin:0px 0px;">
		<a href="#" onmouseover="this.style.cursor='pointer';" target="_blank" style="cursor: pointer;">
			<img border="0" src="wp-content/uploads/2014/04/123.png" alt="" title="" style="">
		</a>				
	</div>
</div>-->
	
<!-- Content -->
<div id="Content">
	<div class="container">

		<!-- .content -->
		<?php 
			if( $sidebar ) echo '<div class="content">';
			
			while ( have_posts() )
			{
				the_post();
				get_template_part( 'includes/content', 'page' );
			}

			if( $sidebar ){
				echo '</div>';
			} else {
				echo '<div class="clearfix"></div>';
			}
		?>	
		
		<!-- Sidebar -->
		<?php 
			if( $sidebar ){
				get_sidebar();
			}
		?>

	</div>
</div>
<?php get_footer(); ?>