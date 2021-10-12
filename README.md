# Implementasi Smart Billing H2H BSI
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
4. Letakkan file config.php, inquiry.php, payment.php, reversal.php dalam
direktori gateway yang dapat diakses oleh publik
5. Ubah isi file config.php:
$biller_name $secret_key $mysql_host $mysql_username $mysql_password $mysql_dbname
= 'PERUSAHAAN XYZ'; = 'SECRET-KEY';
= 'localhost'; = 'root';
= 'root';
= 'db_perusahaan';
6. Tentukan sendiri SECRET-KEY untuk konfigurasi di sistem SmartBilling BPI
7. Pastikan berkas config.php, inquiry.php, payment.php, reversal.php (folder gateway) serta berkas index.php, database.php, style.css (folder demo) diletakkan di suatu webserver yang dapat diakses melalui jaringan internet menggunakan browser
Contoh URL Host-to-Host:<br>
○ index.php dapat diakses pada URL Host to Host Index:<br>
https://serversaya.com/demo/index.php<br>
○ inquiry.php dapat diakses pada URL Host to Host Inquiry:<br>
https://serversaya.com/gateway/inquiry.php<br>
payment.php dapat diakses pada URL Host to Host Payment:<br>
https://serversaya.com/gateway/payment.php<br>
reversal.php dapat diakses pada URL Host to Host Reversal:<br>
https://serversaya.com/gateway/reversal.php

Apabila index.php diakses menggunakan browser akan didapatkan respon sbb: 
![Alt text](https://user-images.githubusercontent.com/26053613/134061383-d64672bc-485d-4af9-98a9-52471c8d2135.png?raw=true "Menampilkan Data")

Apabila payment.php diakses menggunakan browser akan didapatkan respon sbb: 
{blank page / halaman kosong}

Apabila inquiry.php diakses menggunakan browser akan didapatkan respon sbb: 
{"rc":"ERR-PARSING-MESSAGE","msg":"Invalid Message Format"}

Apabila reversal.php diakses menggunakan browser akan didapatkan respon sbb: 
{"rc":"ERR-REVERSAL-DENIED","msg":"Reversal ditolak. Pembayaran sudah update ke DB di Perusahaan"}

KONFIGURASI SANDBOX:
1. Dapatkan akses username & password Institusi untuk masuk ke SANDBOX BPI (https://sandbox.bpi.co.id/)
2. Jika belum mempunyai akun silahkan mendaftar disini (https://sandbox.bpi.co.id/smartbilling/user-register)
3. Masuk ke menu Konfigurasi -> Konfigurasi Umum 
4. Masukkan Token Host to Host Contoh: SECRET-KEY
○ Masukkan URL Host to Host Inquiry<br>
contoh: https://serversaya.com/gateway/inquiry.php<br>
○ Masukkan URL Host to Host Payment<br>
contoh: https://serversaya.com/gateway/payment.php<br>
○ Masukkan URL Host to Host Reversal<br>
contoh: https://serversaya.com/gateway/reversal.php<br>
○ Checklist Host to Host (S&K Berlaku)
○ Klik Submit

UJICOBA TRANSAKSI:
1. Masuk ke menu Tools -> Flagging
2. Lakukan ujicoba INQUIRY dengan memasukkan Nomor Pembayaran (Nomor Siswa: 123456 atau 876876)
3. Lakukan ujicoba PAYMENT dengan klik tombol SELANJUTNYA, Payment Type : Close Payment
4. Kemudian klik tombol BAYAR jika muncul jendela pop-up Tipe Pembayaran pilih Payment Simulation : Receipt Simulation
5. Langkah terakhir klik BAYAR untuk membayar atau BATAL untuk cancel
6. Jika klik tombol BAYAR transaksi pembayaran akan ditampilkan seperti gambar dibawah ini :

![Alt text](https://user-images.githubusercontent.com/26053613/134060197-3433ee7a-3a61-4adc-aa0f-5134894890a6.png?raw=true "Transaksi Berhasil")
