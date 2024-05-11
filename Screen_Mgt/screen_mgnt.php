<?php 
/**
 * This Class use manage screen.
 * Created By Deepak Yadav.
 * 
 */
class screen_mgnt {
	
	function __construct()
	{
		//Created By Deepak Yadav
	}



	public function getIDtoName($screenId){
		$name=explode(".", $screenId);
		return $name[1];
	}//function end

	public function getNametoId($screenName){
		$out=false;
		$list=self::getscreenList();
		if($list){
			$i = 0;
			while($i < count($list))
			{
				$row=explode(".", $list[$i]);
				if($row[1] == $screenName){
					$out=$row;
					break;
				}else{
					$out=false;
				}
				$i++;
			}
		}else{
			$out=false;
		}
		return $out;
	}//function end

	public function screenCount(){
	 	$count=shell_exec("screen -ls |sed '1d'| sed '\$d'|awk '{print \$1}'| wc -l ");
	 	if($count > 0){
	 		return $count;
	 	}else{
	 		return 0;
	 	}
	}//function end

	public function screen(){
	 	$count=self::screenCount();
	 	if($count > 0){
	 		return true;
	 	}else{
	 		return false;
	 	}
	}//function end

	public function getscreenList(){
		$count=self::screenCount();
	 	if($count > 0){
	 		$li=shell_exec("screen -ls |sed '1d'| sed '\$d'|awk '{print \$1}'| tr '\n' ','|sed 's/.\$//'");
	 		$list=explode(",", $li);
	 		return $list;
	 	}else{
	 		return false;
	 	}
	}//fucntion end

	public function CheckScreenById($screenId){
		$list=self::getscreenList();
		if($list){
			if(in_array( $screenId,$list)){
	 		return true;
		 	}else{
		 		return false;
		 	}
		}else{
			return false;
		}
	 	
	}//function end

	public function CheckScrenByName($ScreenName){
		$out=false;
		$list=self::getscreenList();
		$i = 0;
		while($i < count($list))
		{
			$row=explode(".", $list[$i]);
			if($row[1] == $ScreenName){
				$out=true;
				break;
			}
			$i++;
		}
		return $out;
	}//function end

	public function killScreenById($screenId){
		$pre=self::CheckScreenById($screenId);
		if($pre){
			shell_exec("screen -X -S '".$screenId."' quit");
		}else{
			return false;
		}
	}//function end


	public function killScreenById2($screenId){
		$pre=self::CheckScreenById($screenId);
		if($pre){
			$name=self::getIDtoName($screenId);
			$file_name='/var/www/html/screen_mgt/log/'.$name.".log";
			shell_exec("screen -X -S '".$screenId."' quit");
			shell_exec("rm -rf $file_name");
		}else{
			return false;
		}
	}//function end

	public function protect_system($ScreenCommand){
		$out=false;
		if(!is_null($ScreenCommand)){
			switch($ScreenCommand){
			    case "reboot":
			        $out=false;
			        break;
			    case "poweoff":
			        $out=false;
			        break;
			    case "init 6":
			        $out=false;
			        break;
			    case "shutdown":
			        $out=false;
			        break;
			    default:
			    	$out=true;
			}
		}else{
			$out=false;
		}
		return $out;
	}//function end 

	public function setScreenName($ScreenName,$ScreenCommand){
		$ScreenName=$ScreenName."".uniqid();
		if(!is_null($ScreenName) && !is_null($ScreenCommand)){
			if(self::protect_system($ScreenCommand)){
				//screen -S <name> -d -m bash -c "<command >"
				shell_exec("screen -S ".$ScreenName." -d -m bash -c '".$ScreenCommand."'");
				return $ScreenName;
			}else{
				echo "Command Not found";
				return false;
			}
		}else{
			return false;
		}

	}//function end

	public function setScreenName_log($ScreenName,$ScreenCommand){
		$ScreenName=$ScreenName."".uniqid();
		if(!is_null($ScreenName) && !is_null($ScreenCommand)){
			if(self::protect_system($ScreenCommand)){
				//screen -S <name> -d -m bash -c "<command >"
				$logfile=$setScreenName.".log";
				shell_exec("screen -S ".$ScreenName." -d -m bash -c '".$ScreenCommand." > ".$logfile."'");
				return $ScreenName;
			}else{
				echo "Command Not found";
				return false;
			}
		}else{
			return false;
		}
	}

	public function setScreenName_logD($ScreenName,$ScreenCommand){
		$ScreenName=$ScreenName."".uniqid();
		if(!is_null($ScreenName) && !is_null($ScreenCommand)){
			if(self::protect_system($ScreenCommand)){
				//screen -S <name> -d -m bash -c "<command >"
				$logfile="/var/www/html/screen_mgt/log/".$ScreenName.".log";
				$command="screen -S $ScreenName -d -m bash -c '$ScreenCommand 2>&1 |tee $logfile ;rm -rf $logfile'";
				echo $command;
				shell_exec($command);
				return $ScreenName;
			}else{
				echo "Command Not found";
				return false;
			}
		}else{
			return false;
		}

	}//function end


	
	//screen -S test -d -m bash -c 'ping 8.8.8.8 2 >&1 |tee test.log ;rm -rf test.log'

	// $command="screen -S ".$screen_name." -d -m bash -c 'ansible-playbook -i ".$file_name." ".$file_loc."  --extra-vars ".$co."ansible_user=".$user." ansible_password=".$passwoed."".$co." 2>&1 | tee ".$log_file_name."; php ".$directory_path."end_command.php ".$task['exc_id']." ".$log_file_name." ".$screen_name." >> ".$directory_path."excution_dy/end_script_".$screen_name."log.txt  '" ;

}//class end


 ?>