<?php
/**
 * @package 	WordPress
 * @subpackage 	Top Model
 * @version		1.0.1
 * 
 * Profiles Page Horizontal Profile Format Template
 * Created by CMSMasters
 * 
 */




$columns_num = '';
	
if ($profile_columns == 1) {
	$columns_num = 'one_first';
} elseif ($profile_columns == 2) {
	$columns_num = 'one_half';
} elseif ($profile_columns == 3) {
	$columns_num = 'one_third';
} elseif ($profile_columns == 4) {
	$columns_num = 'one_fourth';
} 


$cmsmasters_profile_social = get_post_meta(get_the_ID(), 'cmsmasters_profile_social', true);

$cmsmasters_profile_subtitle = get_post_meta(get_the_ID(), 'cmsmasters_profile_subtitle', true);

?>

<!--_________________________ Start Horizontal Profile _________________________ -->

<article id="post-<?php the_ID(); ?>" <?php post_class('cmsmasters_profile_horizontal ' . $columns_num); ?>>
	<div class="profile_outer">
	<?php 
	if (has_post_thumbnail()) {
		echo '<div class="cmsmasters_profile_img_wrap">';
			
			top_model_thumb_rollover(get_the_ID(), 'cmsmasters-square-thumb', false, true, false, false, false, false, false, false, true, false, false, false, 'cmsmasters_theme_icon_image', 'profile');
		
		echo '</div>';
	}
	
	
	echo '<div class="profile_inner">';
		
		top_model_profile_heading(get_the_ID(), 'h3', $cmsmasters_profile_subtitle, 'h4', true, 'horizontal');
		
		top_model_profile_exc_cont();
		
		top_model_profile_social_icons($cmsmasters_profile_social, $profile_id);
		
	echo '</div>';
	?>
	</div>
</article>
<!--_________________________ Finish Horizontal Profile _________________________ -->

