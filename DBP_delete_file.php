<?php
$DBP_id = $_GET['id'];
$delete_record = $_GET['action'];

DBP_delete_form($DBP_id);

function DBP_delete_form($DBP_id) {
	
		global $wpdb;
	$table_name = $wpdb->prefix."dbp_tb_blog";

     $id = $_POST['id'];
	 $des = $_POST['des'];
	 
	 $wpdb->delete($table_name, 
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
	

?>