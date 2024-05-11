<?php 




function kill_screen($scree_id){
	echo $scree_id."<br>";
	$xa=shell_exec("screen -X -S '".$scree_id."' quit");
	echo $xa;

}//end function.


function get_running_screen(){
	
	$cou=shell_exec("screen -ls |sed '1d'| sed '\$d'|sed '\$d'|awk '{print \$1}'| wc -l ");
	print_r($cou."<br>");	
    if($cou > 0){
        //running
        $cou_get=shell_exec("screen -ls |sed '1d'| sed '\$d'|sed '\$d'|awk '{print \$1}'| tr '\n' ','|sed 's/.$//'");
    	print_r($cou_get."<br>");
    	$Sesson_list=explode(",", $cou_get);
    	print_r($Sesson_list);
    	kill_screen($Sesson_list[0]);
    	return $Sesson_list;
    }else{
     //not running.
    	echo "No any Screen is running";
        return "No any Screen is running";
    }
}//end function.




 ?>