<?php
include "database.php";

$name = $_POST['name'];
$db = new dataBase();	
echo $db->init();

$password = sha1("userpass", TRUE);
$sql = "INSERT INTO users (userid, googleid, name, password) VALUES (unhex('" . uniqid() . "'), 'APA91bFKHQ0PLFebrNHQjZEYfRi-i18SlF519TUGKUZOclK6Gi7MYKjZkbWO6KPBZdjtUMDbdQ-YBieI32JSh20bcSbxzMCbKUIiFNKNE5GOz_YpP2JtabAd_o5qpjaUM565dUrg9C2N', '" . $name . "', '" . $password . "')";
echo $db->query($sql) . "<br>";

$sql = "SELECT hex(userid) as userid, googleid, name, hex(password) as password FROM users";
$res = $db->answerQuery($sql)->fetch_assoc();

if ($res["userid"] != null) {
	echo $res["userid"] . "<br>";
	echo $res["googleid"] . "<br>";
	echo $res["name"] . "<br>";
	echo $res["password"] . "<br>";
	if(strtolower($res["password"]) == sha1("userpass")) {
		echo "YES";
	}
}


// Set POST variables
$url = 'https://android.googleapis.com/gcm/send';

$fields = array(
                'registration_ids'  => array('APA91bFKHQ0PLFebrNHQjZEYfRi-i18SlF519TUGKUZOclK6Gi7MYKjZkbWO6KPBZdjtUMDbdQ-YBieI32JSh20bcSbxzMCbKUIiFNKNE5GOz_YpP2JtabAd_o5qpjaUM565dUrg9C2N'),
                'data'              => array( "message" => $name ),
                );

$headers = array( 
                    'Authorization: key=AIzaSyA7RXf0NKNRMArCV2GYB6SQP-1UehFeyl0',
                    'Content-Type: application/json'
                );

// Open connection
$ch = curl_init();

// Set the url, number of POST vars, POST data
curl_setopt( $ch, CURLOPT_URL, $url );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

// Execute post
$result = curl_exec($ch);

// Close connection
curl_close($ch);

echo $result;

?>