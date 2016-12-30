<!DOCTYPE html>
<html>


	
	
<body>
<center>
<form action=""  method="POST">
<h1>Please Click here to get the twitter details:</h1><br />
<input name="tweets" type="submit" value="TWEETS" ></input>
<input name="friends" type="submit" value="FRIENDS" ></input>
<input name="followers" type="submit" value="FOLLOWERS" ></input>
</form>
<hr />
</center>
</body>
</html>
<?php
include 'config.php';
//// Tweets-List
if (isset($_POST['tweets'])){
	$api_endpoint = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$screen_name.''; // endpoint must support "Application-only authentication"
// request token
$basic_credentials = base64_encode($key.':'.$secret);
$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  =>    'Authorization: Basic '.$basic_credentials."\r\n".
		"Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
		'content' => 'grant_type=client_credentials'
	)
);

$context  = stream_context_create($opts);

// send request
$pre_token = file_get_contents('https://api.twitter.com/oauth2/token', false, $context);

$token = json_decode($pre_token, true);

if (isset($token["token_type"]) && $token["token_type"] == "bearer"){
	$opts = array('http' =>
		array(
			'method'  => 'GET',
			'header'  => 'Authorization: Bearer '.$token["access_token"]       
		)
	);

	$context  = stream_context_create($opts);

	$data = file_get_contents($api_endpoint, false, $context);
	$final = json_decode($data,true);
	
	$final_1 = array ($final);
	$tweets = $final_1; 
	}
	foreach($tweets as $response){
foreach($response as $resp){
	echo "<h2><center>"."Tweets_ID:-"."&nbsp;&nbsp;&nbsp;" .$text=$resp['id']."</center></h2>";
	echo "<br />";
	echo "<h3><center>"."Tweets:-"."&nbsp;&nbsp;&nbsp;" .$text=$resp['text']."</center></h3>" ;
	echo "<br><center><hr></center>";
}
}
}
//// Friends-list///
if (isset($_POST['friends'])){	
$api_endpoint = 'https://api.twitter.com/1.1/friends/list.json?cursor=-1&screen_name='.$screen_name.'&skip_status=true&include_user_entities=false';
// request token
$basic_credentials = base64_encode($key.':'.$secret);
$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  =>    'Authorization: Basic '.$basic_credentials."\r\n".
		"Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
		'content' => 'grant_type=client_credentials'
	)
);
$context  = stream_context_create($opts);
// send request
$pre_token = file_get_contents('https://api.twitter.com/oauth2/token', false, $context);
$token = json_decode($pre_token, true);
if (isset($token["token_type"]) && $token["token_type"] == "bearer"){
	$opts = array('http' =>
		array(
			'method'  => 'GET',
			'header'  => 'Authorization: Bearer '.$token["access_token"]       
		)
	);

	$context  = stream_context_create($opts);

	$data = file_get_contents($api_endpoint, false, $context);
	$final = json_decode($data,true);
	
	$final_1 = array ($final);
	$friend_list = $final_1['0']['users'];
	}
	?>
	<center>
	<h1> Friend List</h1>
	<table>
	<tr>
<th>User ID</th>&nbsp;&nbsp;
<th>User Name</th>
</tr>
	<?php
	foreach($friend_list as $response){
	$use_id=$response['id'];
	$name=$response['name'];
  ?>
<tr><td>&nbsp;&nbsp;&nbsp;<?php echo $use_id;?></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $name;?></td></tr>
  <?php

	}
	?>
</table>
</center>
<?php
}
////Followers-list////
if (isset($_POST['followers'])){	
$api_endpoint = 'https://api.twitter.com/1.1/followers/list.json?cursor=-1&screen_name='.$screen_name.'&skip_status=true&include_user_entities=false';
// request token
$basic_credentials = base64_encode($key.':'.$secret);
$opts = array('http' =>
	array(
		'method'  => 'POST',
		'header'  =>    'Authorization: Basic '.$basic_credentials."\r\n".
		"Content-type: application/x-www-form-urlencoded;charset=UTF-8\r\n",
		'content' => 'grant_type=client_credentials'
	)
);

$context  = stream_context_create($opts);

// send request
$pre_token = file_get_contents('https://api.twitter.com/oauth2/token', false, $context);

$token = json_decode($pre_token, true);

if (isset($token["token_type"]) && $token["token_type"] == "bearer"){
	$opts = array('http' =>
		array(
			'method'  => 'GET',
			'header'  => 'Authorization: Bearer '.$token["access_token"]       
		)
	);

	$context  = stream_context_create($opts);

	$data = file_get_contents($api_endpoint, false, $context);
	$final = json_decode($data,true);
	
	$final_1 = array ($final);
	$followers = $final_1['0']['users'];
}
foreach($followers as $response){
	echo "<h2><center>"."Followers:-"."&nbsp;&nbsp;&nbsp;" .$text=$response['name']."</center>";
	echo "<br /><hr />";
}
}
?>
