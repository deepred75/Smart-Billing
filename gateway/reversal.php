<?php
	require 'config.php';
	debugLog($_JSON);
	
	$kodeBank 			= $_JSON['kodeBank'];
	$kodeChannel 			= $_JSON['kodeChannel'];
	$kodeTerminal 			= $_JSON['kodeTerminal'];
	$nomorPembayaran 		= $_JSON['nomorPembayaran'];
	$idTagihan 			= $_JSON['idTagihan'];
	$tanggalTransaksi 		= $_JSON['tanggalTransaksi'];
	$tanggalTransaksiAsal 		= $_JSON['tanggalTransaksiAsal'];
	$idTransaksi 			= $_JSON['idTransaksi'];
	$totalNominal 			= $_JSON['totalNominal'];
	$nomorJurnalPembukuan 		= $_JSON['nomorJurnalPembukuan'];
	
	// MENOLAK REVERSAL
	$response = json_encode(array(
		'rc' => 'ERR-REVERSAL-DENIED',
		'msg' => 'Reversal ditolak. Pembayaran sudah update ke DB di '.$biller_name
	));
	
	debugLog('RESPONSE: ' . $response);
	echo $response;
?>

