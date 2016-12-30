<?php
session_start();
echo $_SESSION['token'];
$headers =array("Authorization: token OAUTH-TOKEN");
 echo $oauth2token_url = "https://api.github.com/user";
 $clienttoken_post = array(
				"code" => $_SESSION['token']);
				$curl = curl_init($oauth2token_url);
			   curl_setopt($curl, CURLOPT_HTTPHEADER,$headers);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_POSTFIELDS, $clienttoken_post);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
				$json_response = curl_exec($curl);
				//curl_close($curl);	
				 $authObj = json_decode($json_response, true);
				 $token = array($authObj);
				 $final_token = $token['0']['access_token'];
				// $_SESSION['token']=$final_token;
				 echo"<pre>";
				 print_r($json_response);
				 echo"</pre>";
?>