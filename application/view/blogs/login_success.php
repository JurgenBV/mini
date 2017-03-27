<?php
	session_start();
	if(session_is_registered(myusername)) {
		console.log('Login Successful');
	}
?>