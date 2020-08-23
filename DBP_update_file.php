<?php 

$DBP_id = $_GET['id'];
DBP_update_form($DBP_id);

function DBP_update_form($DBP_id) {
	
	
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
      <?php 
	      global $wpdb;
		$table_name = $wpdb->prefix."dbp_tb_blog";
		$DBP_result = $wpdb->get_results("SELECt * FROM $table_name where id = $DBP_id");
		foreach($DBP_result as $DBP_row) {
			 
			 $id = $DBP_row->id;
			 $des = $DBP_row->des;
		}
       ?>
       <form method="post" >
       <H1>Update Blog</H1>
       <h3>ID</h3> <input type="text" name="id" value="<?php echo $id;  ?>"  readonly="readonly" />
       <h3>Description </h3> <input class="content" name="des"  value="<?php echo $des;  ?>" />
       </br>
       <input type="submit" name="Update" value="Update" />
        </form>
             
         <script>
        $(document).ready(function() {
            $('.content').richText();
        });
        </script>

<?php
DBP_update($DBP_id);
}

function DBP_update($DBP_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix."dbp_tb_blog";

     $id = $_POST['id'];
	 $des = $_POST['des'];
	 
	 if(isset($_POST['Update']))
	 {
	 $wpdb->update($table_name, 
				   array(
						 'id'=>$id,
						 'des'=>$des
						 
						 ),
				   array(
						'id'=>$DBP_id
						 )
				   );
	 
	 ?>
    <script>
	// window.location.href = "http://localhost:8080/wordpress-code-new/wp-admin/admin.php?page=blogs";
	window.location.href = "<?php echo admin_url('admin.php?page=blogs'); ?>";
	 
     </script>
     <?php
}
}

?>