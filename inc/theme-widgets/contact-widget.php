<?php
/*
Plugin Name: Contact Info
Plugin URI: http://github.com/jackweinbender/welshimer2013.git
Description: Displays the contact info of PH Welshimer Memorial Library
Author: Jack Weinbender
Version: 1
Author URI: http://github.com/jackweinbender/
*/
 
 
class ContactWidget extends WP_Widget
{
  function ContactWidget()
  {
    $widget_ops = array('classname' => 'ContactWidget', 'description' => 'Displays contact information, properly formatted for search engines' );
    $this->WP_Widget('ContactWidget', 'Contact Info', $widget_ops);
  }
 
  function form($instance)
  {}
 
  function update($new_instance, $old_instance)
  {}
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;

    $content = '<h1 class="contact-icon">Contact</h1>';
	$content .= '<div class="textwidget" itemscope itemtype="http://schema.org/PostalAddress">';
	$content .= 'P.O. Box <span itemprop="postOfficeBoxNumber">600</span><br />';
	$content .= '<span itemprop="streetAddress">200 Blowers Blvd.</span><br />';
	$content .= '<span itemprop="addressLocality">Milligan College</span>, <span itemprop="addressRegion">TN</span> <span itemprop="postalCode">37682</span><br />';
	$content .= '<span itemprop="telephone">423.461.8703</span> (Main Number)<br />';
	$content .= '<span itemprop="telephone">423.461.8494</span> (Circulation Desk)<br />';
	$content .= '<a itemprop="email" href="mailto:library@milligan.edu">library@milligan.edu</a>';
	$content .= '</div>';
 	
 	echo $content;

    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ContactWidget");') );?>