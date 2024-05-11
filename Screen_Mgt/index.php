<?php 
/**
 * 
 * Created By Deepak Yadav.
 * 
 */
require_once("module.php");
require_once("screen_mgnt.php");

$session=new screen_mgnt();

// echo "Hi user<br>";

//  $screen_get=$session->setScreenName("abc","reboot");
//  echo $screen_get."<br>";

// $list=$session->getscreenList();
// print_r($list);

// if($session->CheckScrenByName($screen_get)){
// 	echo "<br>Yes Screen exite.<br>";
// }

// if($list){
// 	$i = 0;
// 	while($i < count($list))
// 	{
// 		if($session->CheckScreenById($list[$i])){
// 			echo "Working on $list[$i]";
// 	 		$session->killScreenById($list[$i]);
// 		 }
// 		 $i=$i+1;
// 	}
// }else{
// 	echo "List is null<br>";
// }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Screen Mgnt</title>
    <link rel="icon" href="screen.png" type="image/icon type">
    <style type="text/css">
        .button2 a { text-decoration: none; }
        .button {
          background-color: #4CAF50; /* Green */
          border: none;
          color: white;
          padding: 5px 10px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          font-size: 16px;
          margin: 2px 1px;
          transition-duration: 0.4s;
          cursor: pointer;
}
        .button2 {
              background-color: white; 
              color: black; 
              border: 2px solid #008CBA;
              border-radius: 20px;
            }

            .button2:hover {
              background-color: #008CBA;
              color: white;
            }
         
        table {󠀮󠀮󠀮󠀮
              border-collapse: collapse;
              width: 100%;
              border-radius: 50px;
            }

            th, td {
              text-align: left;
              padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
              background-color: #04AA6D;
              color: white;
            }
        .fls{
            
            width: 50%;
            border-style: dotted;
            border-color: blue;
            border-radius: 20px;

        }
        .fls2{
            
            width: 50%;
            border-style: dotted;
            border-color: green;
            border-radius: 20px;
            color: blue;
        }
        .addsc{
            display: inline;
            padding: 40px;
            width: 50%;
            border-style: dotted;
            border-color: orange;
            border-radius: 50px;
            background-color: #f2f2f2;

        }
       input[type=text], select, textarea {
              width: 100%;
              padding: 12px;
              border: 1px solid #ccc;
              border-radius: 4px;
              resize: vertical;
            }
        input[type=submit] {
              background-color: #04AA6D;
              color: white;
              padding: 12px 20px;
              border: none;
              border-radius: 4px;
              cursor: pointer;
              float: left;
            }
    </style>
</head>
<body>
<h1> Screen Management Lib.</h1>
<h5>Ceated By Deepak Yadav</h5>
<form>
    <fieldset class="fls">
        <legend>Running Screens</legend>
        <?php
        $list=$session->getscreenList();
        //print_r($list);
        if($list){
            $i=0;
            echo "<table class='tab'><tr><th>No.</th><th>Name</th><th>Action</th></tr>";
            while($i < count($list)) {
            echo "<tr><td>".$i."</td><td>".$list[$i]."</td><td><a class='button button2' href='termiScreen.php?id=".$list[$i]."'>🚫 Terminate</a> &nbsp;<a class='button button2' href='screenView.php?id=".$list[$i]."'> 🏇 Live log View</a>&nbsp;<a class='button button2' href='screenView.php?id=".$list[$i]."'> 🧐 Full log View</a></td></tr>";
            $i=$i+1;
            }
            echo "</table>";

        }else{
            echo "Screen Count 0";
        }

    ?>
    </fieldset>
</form>
<br>
<hr>
<br>
<form action="addscree.php" method="post" accept-charset="utf-8">
    <fieldset class="addsc">
        <legend>Add Screen</legend>
        <input type="text" placeholder="Enter Screen Name" name="name" required><br><br>
        <input type="text" placeholder="Enter command" name="command" required><br><br>
        <input type="submit" name="submit" value="Submit">
    </fieldset>
</form>

<br>
<hr>
<br>
<fieldset class="fls2">
        <legend>Row Output</legend>
        <?php 
        $get = shell_exec("screen -ls");
        if ($get === null) {
            echo 'Exception : Command execution failed (command not found)';
        }
        echo "<pre>";
        echo $get;
        echo "<pre>";
        ?>
    </fieldset>
</body>
</html>