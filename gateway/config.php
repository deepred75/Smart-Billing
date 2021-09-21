<?php
	$biller_name		= 'MALANGGLEERRR'; 					// UBAH VARIABEL INI
	$secret_key		= '!jK%5XGX-M0)8_NIXb1Ldjj{u2>9L';			// UBAH VARIABEL INI
	$mysql_host		= 'localhost';						// UBAH VARIABEL INI 
	$mysql_username		= 'u9158949_bsi';					// UBAH VARIABEL INI
	$mysql_password		= '@21eC2020!';						// UBAH VARIABEL INI 
	$mysql_dbname		= 'u9158949_bsi';					// UBAH VARIABEL INI
	
	$allowed_collecting_agents	= array('BSM');
	$allowed_channels 		= array('TELLER', 'IBANK', 'ATM', 'MBANK', 'FLAGGING');
	$log_directory 			= './logs/'; // Direktori ini harus bisa ditulis oleh Apache / PHP user
	
	function debugLog($o) {
		// Fungsi ini untuk menulis seluruh log ke file
		$file_debug = $GLOBALS['log_directory'] . 'debug-h2h-' . date("Y-m-d") . '.log.txt';
		ob_start();
		var_dump(date("Y-m-d H:i:s")); 
		var_dump($o);
		$c = ob_get_contents(); 
		ob_end_clean();
		
		$f = fopen($file_debug, "a"); 
		fputs($f, "$c\n"); 
		fflush($f);
		fclose($f);
	}
	
	debugLog('REQUEST: ');
	$request = file_get_contents('php://input'); 
	debugLog($request);
	$_JSON = json_decode($request, true);
?>

