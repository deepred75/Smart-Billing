# Smart Billing Bank Syariah Indonesia
Contoh Implementasi Host to Host Smart Billing BPI Bank Syariah Indonesia Pembayaran Institusi

KEBUTUHAN APLIKASI:
1. Apache 2.4 dengan PHP 7.0+
2. Modul PHP MySQL, PHP JSON
3. Webserver yang dapat diakses melalui IP Publik
4. Mengizinkan akses pemanggilan dari IP 103.219.249.4 ke webservice Anda

CARA INSTALASI CEPAT:
1. Buat sebuah database dengan nama "db_perusahaan"
2. Beri akses user "root" dengan password "root" untuk mengakses "db_perusahaan"
3. Import file "u9158949_bsi.sql" ke dalam database "db_perusahaan"
4. Letakkan file config.php, inquiry.php, payment.php, dan reversal.php pada sebuah
direktori yang dapat diakses oleh publik
5. Ubah isi file config.php:
$biller_name $secret_key $mysql_host $mysql_username $mysql_password $mysql_dbname
= 'PERUSAHAAN XYZ'; = 'SECRET-KEY';
= 'localhost'; = 'root';
= 'root';
= 'db_perusahaan';
6. Tentukan sendiri SECRET-KEY untuk konfigurasi di sistem SmartBilling BPI
7. Pastikan berkas index.php, inquiry.php, payment.php, dan reversal.php diletakkan di suatu webserver yang dapat diakses melalui jaringan internet menggunakan browser
Contoh URL Host-to-Host:
○ index.php dapat diakses pada URL Host to Host Index:
https://serversaya.com/demo/index.php
○ inquiry.php dapat diakses pada URL Host to Host Inquiry:
https://serversaya.com/gateway/inquiry.php
payment.php dapat diakses pada URL Host to Host Payment:
https://serversaya.com/gateway/payment.php
reversal.php dapat diakses pada URL Host to Host Reversal:
https://serversaya.com/gateway/reversal.php

Apabila index.php diakses menggunakan browser, akan didapatkan respon sbb: 
{semua isi tabel dalam database akan ditampilan}

Apabila payment.php diakses menggunakan browser, akan didapatkan respon sbb: 
{blank page / halaman kosong}

Apabila inquiry.php diakses menggunakan browser, akan didapatkan respon sbb: 
{"rc":"ERR-PARSING-MESSAGE","msg":"Invalid Message Format"}

Apabila reversal.php diakses menggunakan browser, akan didapatkan respon sbb: 
{"rc":"ERR-REVERSAL-DENIED","msg":"Reversal ditolak. Pembayaran sudah update ke DB di Perusahaan"}
