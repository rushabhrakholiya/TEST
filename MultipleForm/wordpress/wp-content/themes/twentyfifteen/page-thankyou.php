<?php
/**
 * Template Name: Thank you
 */

get_header(); ?>
<?php 
	/*header('Content-Type: application/json');
	$arr[] = array("test1"=>array("test description1","test description2"));
	$arr[] = array("test2"=>array("test description4","test description3"));
	$finalarr["data"] = $arr;
	echo json_encode($finalarr);*/
	//echo str_replace(array('[', ']'), '', htmlspecialchars(json_encode($finalarr), ENT_NOQUOTES));
?>
<?php /*<script>window.ajaxurl = '<?php echo get_bloginfo('template_url'); ?>/ajax.php'; </script> */ ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php	
			print "<pre>"; print_r($_REQUEST); print "</pre>";
		?>
		<div id="nearest-location"></div>
		</main><!-- .site-main -->		
	</div><!-- .content-area -->
	
<?php get_footer(); ?>
 <?php /* <script>

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("not supported");
    }
}
function showPosition(position) {

	jQuery.ajax({
	   url: ajaxurl,
	   data: {latitude: position.coords.latitude, longitude: position.coords.longitude},
	   error: function() {
	      $('#info').html('<p>An error has occurred</p>');
	   },	   
	   success: function(data) {
	   		jQuery("#nearest-location").html(data);	      
	   },
	   type: 'POST'
	});

}

jQuery(document).ready(function(){
	getLocation();
});
</script> */ ?>