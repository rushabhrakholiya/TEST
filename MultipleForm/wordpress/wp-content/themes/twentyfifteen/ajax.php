<?php 
include '../../../wp-config.php';

$latitude = $_REQUEST['latitude'];
$longitude = $_REQUEST['longitude'];


$sql = "select p.ID, p.post_name, ((ACOS(SIN(".$latitude."* PI() / 180) * SIN(latitude.meta_value * PI() / 180) + COS(".$latitude." * PI() / 180) * COS(latitude.meta_value * PI() / 180) * COS(( ".$longitude." - longitude.meta_value) * PI() / 180)) * 180 / PI()) * 60 * 1.1515) AS distance from wp_posts p left join wp_postmeta latitude on latitude.post_id = p.ID and latitude.meta_key = 'bgmp_latitude' left join wp_postmeta longitude on longitude.post_id = p.ID and longitude.meta_key = 'bgmp_longitude' having distance < 25 ";

$results = $wpdb->get_results($sql) or die(mysql_error());

	$html = "<ul>";
    foreach( $results as $result ) {


    	$html .= "<li>";
    		$html .= "<div class='name'>";
    		$html .= "<label>Name : </label>";
        	$html .= $result->post_name;
        	$html .= "</div>";

        	$html .= "<div class='distance'>";
    		$html .= "<label>Distance : </label>";
    		$html .= "You Approx ";
        	$html .= round($result->distance * 1.609344);
        	$html .= " KM far from here";
        	$html .= "</div>";

        $html .= "</li>";

    }
    $html .= "</ul>";
    echo $html;
?>