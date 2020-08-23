<?php
/*
Plugin Name: blog
Plugin URI:
Description: My first Plugin 
Author: Ashish
Author URI: www.ashishsompura.com
Version: 0.1


*/

if(!defined('ABSPATH'))
{
	define('ABSPATH', dirname(_FILE_) . '/');
} 

 include_once("DBP_db_file.php");
 
 
add_action("admin_menu", "addmenu");

DBP_tb_create();
function addmenu()
{
	add_menu_page("blog by ashish", "blog by ashish","manage_options","blogs","blog");

}



function blog()
{      
     if(isset($_GET['id']) && $_GET['action'] == "edit")
		{
			include_once('DBP_update_file.php');
			
		}
    else  
	{
?>
       <style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
textarea{
 width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #000000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo home_url( '/' ); ?>wp-content/plugins/search-records/css/site.css">
        <link rel="stylesheet" href="<?php echo home_url( '/' );?>wp-content/plugins/search-records/js/richtext.min.css">
        <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/search-records/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo home_url( '/' ); ?>wp-content/plugins/search-records/js/jquery.richtext.js"></script>


       <form method="post" >
       <H1>Add Blog</H1>
       <h3>ID</h3> <input type="text" name="id" />
       <h3>Description </h3> <textarea class="content" name="des" ></textarea>
       </br>
       <input type="submit" name="Add" />
        </form>
             
         <script>
        $(document).ready(function() {
            $('.content').richText();
        });
        </script>
        
        <?php 
		global $wpdb;
		$table_name = $wpdb->prefix."dbp_tb_blog";
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name");
		
			if(isset($_GET['id']) && $_GET['action'] == "delete")
		{
			include_once('DBP_delete_file.php');
			
		}
		
		else
		?>
        <table id="customers" >
        <tr>
        <th>ID</th>
        <th>Descriptions</th>
        <th>Action</th>
        </tr>
         <?php foreach($DBP_result as $DBP_row) {
			 
			 $id = $DBP_row->id;
			 $des = $DBP_row->des;
		
		 ?>
        <tr>
        <td> <?php echo $id; ?></td>
        <td><?php echo $des; ?></td>
        <td><a href="<?php echo admin_url('admin.php?page=blogs&action=edit&id='.$id); ?>">Update </a> / <a href="<?php echo admin_url('admin.php?page=blogs&action=delete&id='.$id); ?>">Delete </a></td>
        </tr>
        <?php } ?>
        </table>
        
<?php


DBP_insert_data();
}
}



function DBP_insert_data() {
 
  global $wpdb;
	$table_name = $wpdb->prefix."dbp_tb_blog";

     $id = $_POST['id'];
	 $des = $_POST['des'];
	 
	 if(isset($_POST['Add']))
	 {
	 $wpdb->insert($table_name, 
				   array(
						 'id'=>$id,
						 'des'=>$des
						 
						 ),
				   array(
						 '%d', // use integer format  
						 '%s'  // use string format
						 )
				   );
	 
}
}

function DBP_show_data() {
 
 global $wpdb;
		$table_name = $wpdb->prefix."dbp_tb_blog";
		?>
		<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
textarea{
 width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=submit] {
  width: 100%;
  background-color: #000000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>

<form method="post" >
       <H3>Search Blog</H3>
       <h5>ID</h3> <input type="text" name="id" />
       </br>
       <input type="submit" name="search" value="Search " />
        </form>
		<?php 
		if(isset($_POST['search']))
	 {
		$id = $_POST['id'];
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name where id = $id");
		
		?>
        <table id="customers" >
        <tr>
        <th>ID</th>
        <th>Des</th>
        </tr>
         <?php foreach($DBP_result as $DBP_row) {
			 
			 $id = $DBP_row->id;
			 $des = $DBP_row->des;
		
		 ?>
        <tr>
        <td> <?php echo $id; ?></td>
        <td><?php echo $des; ?></td>
        
        </tr>
        <?php } ?>
        </table>
 <?php       	 
}
}

add_shortcode( 'cr_custom_search', 'custom_search_shortcode' );
function custom_search_shortcode() {
    ob_start();
    DBP_show_data();
    return ob_get_clean();
}

?>