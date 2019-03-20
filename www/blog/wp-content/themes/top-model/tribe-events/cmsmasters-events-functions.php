<?php
/**
 * @package 	WordPress
 * @subpackage 	Top Model
 * @version 	1.0.0
 * 
 * Website Events Functions
 * Created by CMSMasters
 * 
 */


/* Replace Styles */
function top_model_replace_tribe_events_calendar_stylesheet() {
	$styleUrl = '';
	
	
	return $styleUrl;
}

add_filter('tribe_events_stylesheet_url', 'top_model_replace_tribe_events_calendar_stylesheet');


/* Replace Pro Styles */
function top_model_replace_tribe_events_calendar_pro_stylesheet() {
	$styleUrl = '';
	
	
	return $styleUrl;
}

add_filter('tribe_events_pro_stylesheet_url', 'top_model_replace_tribe_events_calendar_pro_stylesheet');


/* Replace Widget Styles */
function top_model_replace_tribe_events_calendar_widget_stylesheet() {
	$styleUrl = '';
	
	
	return $styleUrl;
}

add_filter('tribe_events_pro_widget_calendar_stylesheet_url', 'top_model_replace_tribe_events_calendar_widget_stylesheet');


/* Replace Responsive Styles */
function top_model_customize_tribe_events_breakpoint() {
    return 768;
}

add_filter('tribe_events_mobile_breakpoint', 'top_model_customize_tribe_events_breakpoint');


/* Add class to next button in single event navigation */
function top_model_tribe_link_next_class($format){
	$format = str_replace('href=', 'class="cmsmasters_next_post" href=', $format);
	
	return $format;
}

add_filter('tribe_the_next_event_link', 'top_model_tribe_link_next_class');


/* Add class to previous button in single event navigation */
function top_model_tribe_link_prev_class($format) {
	$format = str_replace("href=", 'class="cmsmasters_prev_post" href=', $format);
	
	return $format;
}

add_filter('tribe_the_prev_event_link', 'top_model_tribe_link_prev_class');
