<?php
	require 'config.php';
 	debugLog($_JSON);
 	
 	// PARAMATER DI BAWAH INI ADALAH VARIABEL YANG DITERIMA DARI BSI
 	$kodeBank			= $_JSON['kodeBank'];
	$kodeChannel			= $_JSON['kodeChannel'];
	$kodeBiller			= $_JSON['kodeBiller'];
	$kodeTerminal			= $_JSON['kodeTerminal'];
	$nomorPembayaran		= $_JSON['nomorPembayaran'];
	$tanggalTransaksi		= $_JSON['tanggalTransaksi'];
	$idTransaksi			= $_JSON['idTransaksi'];
	$totalNominalInquiry		= $_JSON['totalNominalInquiry'];
	
	// PERIKSA APAKAH SELURUH PARAMETER SUDAH LENGKAP
	if (empty($kodeBank) || empty($kodeChannel) || empty($kodeTerminal) || 
	empty($nomorPembayaran) || empty($tanggalTransaksi) || empty($idTransaksi)) {
		$response = json_encode(array(
			'rc' => 'ERR-PARSING-MESSAGE',
			'msg' => 'Invalid Message Format' 
		));
		debugLog('RESPONSE: ' . $response); 
			echo $response;
		exit();
	}
	
	// PERIKSA APAKAH KODE BANK DIIZINKAN MENGAKSES WEBSERVICE INI
	
	if (!in_array($kodeBank, $allowed_collecting_agents)) {
		$response = json_encode(array(
			'rc' => 'ERR-BANK-UNKNOWN',
			'msg' => 'Collecting agent is not allowed by '.$biller_name
		));
		debugLog('RESPONSE: ' . $response); 
			echo $response;
		exit();
	}
	
	// PERIKSA APAKAH KODE CHANNEL DIIZINKAN MENGAKSES WEBSERVICE INI
	
	if (!in_array($kodeChannel, $allowed_channels)) {
		$response = json_encode(array(
			'rc' => 'ERR-CHANNEL-UNKNOWN',
			'msg' => 'Channel is not allowed by '.$biller_name
		));
		debugLog('RESPONSE: ' . $response); 
		echo $response;
		exit();
	}
	
	// PERIKSA APAKAH CHECKSUM VALID
	
	if (sha1($_JSON['nomorPembayaran'].$secret_key.$_JSON['tanggalTransaksi']) != 
		$_JSON['checksum']) {
			$response = json_encode(array(
			'rc' => 'ERR-SECURE-HASH',
			'msg' => 'H2H Checksum is invalid'
		));
		debugLog('RESPONSE: ' . $response); 
		echo $response;
		exit();
	}
	
	$conn = mysqli_init();
	$conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 3); 
	$conn->options(MYSQLI_OPT_READ_TIMEOUT, 7);
	$conn->real_connect($mysql_host, $mysql_username, $mysql_password, $mysql_dbname);
	
	$sql = $conn->prepare("SELECT * FROM tagihan_pembayaran WHERE nomor_siswa = ? order by 
	tanggal_invoice desc limit 1");
	$sql->bind_param('s', $nomorPembayaran);
	$sql->execute();
	$result_cek = $sql->get_result();
	$data_cek_available = $result_cek->fetch_array(MYSQLI_ASSOC); 
	debugLog($data_cek_available);
	
	if($data_cek_available['nama'] == '') { 
	// APABILA NAMA TIDAK DITEMUKAN 
	$response = json_encode(array(
		'rc' => 'ERR-NOT-FOUND',
		'msg' => 'Nomor Tidak Ditemukan' 
		));
		debugLog('RESPONSE: ' . $response); 
		echo $response;
	exit();
	
	}
	
	$sql = $conn->prepare("SELECT * from tagihan_pembayaran where nomor_siswa = ? AND 
	status_pembayaran is NULL order by tanggal_invoice desc limit 1"); 
	$sql->bind_param('s', $nomorPembayaran);
	$sql->execute();
	$result_tagihan = $sql->get_result();
	$data_tagihan = $result_tagihan->fetch_array(MYSQLI_ASSOC); 
	debugLog($data_tagihan);
	
	if($data_tagihan['nama'] == '' ) {
		// APABILA tidak ada nama yang bisa diambil berarti semua sudah SUKSES / terbayar 
		$response = json_encode(array(
			'rc' => 'ERR-ALREADY-PAID',
			'msg' => 'Sudah Terbayar' 
		));
		debugLog('RESPONSE: ' . $response); 
		echo $response;
		$conn->close();
		exit();
	}
	
	$nama = $data_tagihan['nama']; 
	$id_tagihan = $data_tagihan['id_invoice']; 
	$all_info = $data_tagihan['informasi'];
	$info1 = substr($all_info, 0, 30);
	$info2 = substr($all_info, 30, 30);
	$arr_informasi = [
		['label_key' => 'Info1', 'label_value' => $info1 ],
		['label_key' => 'Info2', 'label_value' => $info2 ], 
	];
	$nominalTagihan = intval($data_tagihan['nominal_tagihan']); 
	$arr_rincian = [
		[
			'kode_rincian' => 'TAGIHAN', 
			'deskripsi' => 'TAGIHAN', 
			'nominal' => $nominalTagihan
		], 
	];
	
	$data_inquiry = [
		'rc'			=> 'OK',
		'msg' 			=> 'Inquiry Succeeded',
		'nomorPembayaran' 	=> $nomorPembayaran,
		'idPelanggan' 		=> $nomorPembayaran,
		'nama' 			=> $nama,
		'totalNominal' 		=> $nominalTagihan,
		'informasi' 		=> $arr_informasi,
		'rincian' 		=> $arr_rincian,
		'idTagihan'		=> $id_tagihan,
	];
	
	$response_inquiry = json_encode($data_inquiry); 
	debugLog('RESPONSE: ' . $response_inquiry); 
	header('Content-Type: application/json');
	echo $response_inquiry;
	exit(); 
?>
