
<?php

    //Connecting to Redis server on localhost 
    try {
        $redis = new Redis();
        $redis->connect('redis', 6379);

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $client_ip_address = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $client_ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $client_ip_address = $_SERVER['REMOTE_ADDR'];
        }

        if ($redis->hExists('visitor_stats', $client_ip_address)) {
           $my_array = $redis->hMget("visitor_stats",  array($client_ip_address));
           $total_counts = $my_array[$client_ip_address] + 1;
        } else {
           $total_counts = 1;
        }

        $redis->hSet('visitor_stats', $client_ip_address, $total_counts);

        echo "Welcome, your IP is " . $client_ip_address . ". You've visited this page ".  $total_counts . " times\n";

    } catch (Exception $e) {
        echo $e->getMessage();
    }
 


   //database connection config
	$hostname="db";
	$db_user="root";
	$db_pass="root";
	$db_name="mysql";

	//connecting to database
	$connection=mysqli_connect($hostname, $db_user, $db_pass, $db_name);
	if(mysqli_connect_errno()){
		die("Error connecting to Database");
	}

	//adding new visitor
	$visitor_ip=$_SERVER['REMOTE_ADDR'];

	//checking if the visitor is unique
	$query="SELECT * FROM counter_table WHERE ip_address='$visitor_ip'";
	$result=mysqli_query($connection, $query);

	//checking query error
	if(!$result){
		die("Retriving Query Eroor<br>".$query);
	}
	$total_visitors=mysqli_num_rows($result);
	if($total_visitors<1){
		$query="INSERT INTO counter_table(ip_address) VALUES('$visitor_ip')";
		$result=mysqli_query($connection, $query);
	}


	//retriving existing visitors
	$query="SELECT * FROM counter_table";
	$result=mysqli_query($connection, $query);

	//checking query error
	if(!$result){
		die("Retriving Query Eroor<br>".$query);
	}
	$total_visitors=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.wrapper{
			height: 300px;
			width: 300px;
			background-color: skyblue;
			margin: auto;
			text-align: center;
			border: 1px solid white;
			box-shadow: 2px 2px 10px gray;
		}
		h1{
			background-color: mediumseagreen;
			color: white;
			border-bottom: 2px solid white;
		}
		h3{
			font-size: 5em;
		}
		h1,h3{
			padding: 20px;
			margin: 0px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<h1>
			Unique Visitorsa Count
		</h1>
		<h3><?php echo $total_visitors; ?></h3>
	</div>
</body>
</html>
