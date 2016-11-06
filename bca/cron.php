<?php

error_reporting( E_ALL );
require( 'IbParser.php' );
$parser = new IbParser();


include 'db.php';


$connect_db=mysql_connect($host_name, $user_name, $password);

$find_db=mysql_select_db($database);

if ($find_db) {
 
 $query = "SELECT * FROM konfigurasi";
 $hasil = mysql_query($query);
 
 while ( $kolom_db = mysql_fetch_assoc($hasil) ) {
 
  $userbca = $kolom_db['userbca'];
  $pwd = $kolom_db['password'];
 }
 
  //mysql_close($connect_db);
 
}else {
 
  echo "Database Tidak Ada";
 
  mysql_close($connect_db);
 
}

 
?>


<!--
<pre>
IP Server     : <?php echo $parser->conf['ip']; ?>

Tanggal & Jam : <?php echo date( 'Y-m-d H:i:s', $parser->conf['time'] ); ?>

Path          : <?php echo $parser->conf['path']; ?>

Writable      : <?php echo ( is_writable( $parser->conf['path'] ) )? 'Ya': '<span style="color: #ff0000;">Tidak!</span>'; ?>

</pre>
-->

<?php

$bank   = 'BCA';
$user   = $userbca;
$pass   = base64_decode($pwd);
 
$balance = $parser->getBalance( $bank, $user, $pass );
$rek = $parser->getRek( $bank, $user, $pass );
$matauang = $parser->getMataUang( $bank, $user, $pass );
 
?>
 
<pre>
Akun          : <?php echo $bank; ?>

User BCA      : <?php echo $user; ?>
 
Rekening      : <?php echo ( !$rek )? 'Gagal mengambil no. rekening': print_r( $rek, true ); ?>

Mata Uang     : <?php echo ( !$matauang )? 'Gagal mengambil mata uang': print_r( $matauang, true ); ?>

Saldo         : <?php echo ( !$balance )? 'Gagal mengambil saldo': number_format( $balance, 2 ); ?>

</pre>
 
<?php $transactions = $parser->getTransactions( $bank, $user, $pass ); ?>
<pre>Transaksi     : <?php echo ( !$transactions )? 'Gagal mengambil transaksi': print_r( $transactions, true ); ?></pre>


	<?php 
	$jumlah = '';
	$cek1 = '';
	$cek2 = '';

	$query = "SELECT DISTINCT * FROM detailbca";
	$hasil = mysql_query($query);
	$jumlah =  mysql_num_rows($hasil);

	$data="update konfigurasi set jml1=".$jumlah;
	mysql_query($data); 

	$querycek = "select jml1,jml2 from konfigurasi";
	$hasilcek = mysql_query($querycek);
	
	while ( $kolom_db = mysql_fetch_assoc($hasilcek) ) {

		$cek1 = $kolom_db['jml1'];
		$cek2 = $kolom_db['jml2'];

	}				 

	if( $cek1===$cek2 ){
		// status benar
	}else{
		
		//ambil transaksi mulai dari $jumlah sampai terakhir.
		
		$hapus = "drop table tmpdata";
		mysql_query($hapus);
		
		$data = "create table tmpdata select distinct * from detailbca limit ".$cek2.",".$jumlah."";
		mysql_query($data); 

		$tampildata = "select * from tmpdata";
		$hasil = mysql_query($tampildata); 
		
		$tampung = array();
		while ( $kolom = mysql_fetch_assoc($hasil) ) {
			$tampung = $tampung."<br>".$kolom['tgl']." # ".$kolom['ket']." # ".$kolom['mkode']." # ".$kolom['mutasi'];
		}


		$header = "select * from headerbca";
		$tampil = mysql_query($header);
		while ($data = mysql_fetch_assoc($tampil) ) {
			$saldo = $data['saldo'];
			$norek = $data['norek'];
			$userbca = $data['nama'];
		}
		
		$email = "select userbca,email from konfigurasi";
		$tampilemail = mysql_query($email);
		while ($dataemail = mysql_fetch_assoc($tampilemail) ) {
			$email = $dataemail['email'];
			$user = $dataemail['userbca'];
		}
		
		$emailto = $email;                         
		$headers = "Content-type: text/html; charset=iso-8859-1\r\n";  
		$subject = "BCA - Mutasi Rekening";     

		$headers .= "MIME-Version: 1.0\r\n"; 
		$headers .= "Organization: Auto Email BCA\r\n"; 

		//$headers .= "To: ".$emailto."\r\n"; 
		$headers .= "X-Priority: normal\r\n"; 
		$headers .= "X-MSMail-Priority: Normal\r\n"; 
		$headers .= "Importance: High\r\n"; 
		$headers .= "X-Mailer: PHP v" . phpversion()."\r\n"; 
		$headers .= "MIME-Version: 1.0\r\n"; 
		$headers .= "From: Auto BCA <autobca@sdp.mail>\r\n"; 
		$headers .= "Delivery-date: ".date("r")." -0300\r\n"; 
		$headers .= "X-Originating-IP: [".getenv("REMOTE_ADDR")."]\r\n"; 
		$headers .= "X-Sender-IP: " . $_SERVER["REMOTE_ADDR"]."\r\n"; 
		$headers .= "Content-Transfer-Encoding: 8bit\r\n"; 
		$message = '<div style="font-family:Courier; color:#333;">
					<font size="5" color=""><b>Mutasi Rekening BCA</b></font>
					<br>-----------------------------<br>
					<font size="4" color="">
					<pre>
Akun           : BCA
User Bca       : '.$user.'
No. Rekening   : '.$norek.'
Saldo terakhir : Rp. '.$saldo.'
Data Mutasi    :
'.substr($tampung,5,10000).'
					</pre>
					</font>
					</div>';

		mail($emailto, $subject,$message,$headers);

		
		//update data[jml2] menjadi $jumlah
		$updjml2 = "update konfigurasi set jml2 = ".$jumlah;
		mysql_query($updjml2);
	}


		$a1="CREATE TABLE tmp SELECT DISTINCT * FROM detailbca";
		$retvalheader = mysql_query( $a1, $conn );
		$a2="DROP TABLE detailbca";
		$retvalheader = mysql_query( $a2, $conn );
		$a3="RENAME TABLE tmp TO detailbca";
		$retvalheader = mysql_query( $a3, $conn );
	
	?>