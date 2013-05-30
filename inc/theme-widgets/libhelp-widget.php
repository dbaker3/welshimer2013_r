<?php 

/*
Plugin Name: LibraryH3lp Widget
Plugin URI: http://github.com/jackweinbender/welshimer2013.git
Description: Displays a LibraryH3lp button
Author: Jack Weinbender
Version: 1
Author URI: http://github.com/jackweinbender/
*/
 
class LibHelpWidget extends WP_Widget
{
  function LibHelpWidget()
  {
    $widget_ops = array('classname' => 'LibHelpWidget', 'description' => 'Displays button for LibraryH3lp service' );
    $this->WP_Widget('LibHelpWidget', 'LibraryH3lp Button', $widget_ops);
  }
 
  function form($instance)
  {}
 
  function update($new_instance, $old_instance)
  {}
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;

    $content = '<h1 class="chat-icon">Live Chat</h1>';
	$content .='<div class="needs-js textwidget">Chat service is unavailable. Please ensure that <a href="http://enable-javascript.com/">Javascript is enabled</a></div>';
 	
 	echo $content;

    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("LibHelpWidget");') );?>