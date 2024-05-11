<?php 
/**
 * 
 * Created By Deepak Yadav.
 * 
 */
require_once("screen_mgnt.php");
//print_r($_GET);
if($_GET == null){
	echo "Get null";  
}else{
	$session=new screen_mgnt();
	$get=$session->killScreenById2($_GET['id']);
	echo $get;
	header("Location: index.php"); 
}

?>