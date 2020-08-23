<?php 

/*  Creating table for plugin  */

function DBP_tb_create()
{
	
	global $wpdb;
	$DBP_tb_name = $wpdb->prefix ."dbp_tb_blog";
	
	$DBP_query = "CREATE TABLE $DBP_tb_name( 
											id int (10) NOT NULL,
                                            des varchar (500) DEFAULT '',
											PRIMARY KEY (id)
                                             
	
)";
	
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta($DBP_query); 
}

register_activation_hook( __FILE__, 'DBP_tb_create' );





?>