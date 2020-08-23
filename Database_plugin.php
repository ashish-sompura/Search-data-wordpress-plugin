
<?php
if(!defined('ABSPATH'))
{
	define('ABSPATH', dirname(_FILE_) . '/');
} 

 include_once("DBP_db_file.php");
 register_activation_hook(_FILE_,"DBP_tb_create");
 DBP_insert_data();
 ?>