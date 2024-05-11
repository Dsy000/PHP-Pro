<?php 
/**
 * 
 * Created By Deepak Yadav.
 * 
 */
require_once("screen_mgnt.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Output</title>
	<style type="text/css">
		body{
			background-color: black;
			color: lightgreen;
			font-size: 18px;
		}
	</style>
	</head>
<body>
<div>
<?php 
if($_GET == null){
	echo "Get null";  
}else{
	$session=new screen_mgnt();
	if(isset($_GET['id']) && !is_null($_GET['id'])){
		$screen_id=$_GET['id'];
		$name=$session->getIDtoName($screen_id);
		$file=$name.".log";
		if($session->CheckScreenById($screen_id)){
			$cmd = "tail -f /var/www/html/screen_mgt/log/$file";
			//echo shell_exec($cmd);
			while (@ ob_end_flush()); // end all output buffers if any
				$proc = popen($cmd, 'r');
				echo '<pre>';
				while (!feof($proc))
				{
				    echo fread($proc, 4096);
				    @ flush();
				}
				echo '</pre>';		    
		}else{
			echo "Sorry Screen not found.";
		}
	}else{
		echo "Hi Session Id not found";
	} 
}
?>
    
</div>
	
</body>
</html>