<?php
$db = array(
			'connectionString' => 'mysql:host=localhost;dbname=registration',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		);
$params = array(
		'adminEmail'=>'webmaster@example.com',
		'sendEmail' => False,
		'stopMutiLogin' => False,
		'gmailId' => 'testmary92@gmail.com',
		'password' => 'Ezhilmary92',
		// 'loginTimeoutSeconds'=>5*60,  //timeout value in seconds
		'loginTimeoutSeconds'=> 5*60,  //timeout value in seconds
		'activateRememberMeOption'=>False,  //timeout value in seconds
		'rememberMeDuration'=>3600*24*30,  //30 Days
	);
?>