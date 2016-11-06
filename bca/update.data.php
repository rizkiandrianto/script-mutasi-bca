<?php

$user = $_POST['user'];
$pass = $_POST['pass'];
$pmutasi = $_POST['pmutasi'];
$email = $_POST['email'];
$refresh = $_POST['refresh'];
$temp = $_POST['tmp'];
$tmpuser = $_POST['tmpuser'];

include 'db.php';

$connect_db=mysql_connect($host_name, $user_name, $password);
$find_db=mysql_select_db($database);
if ($find_db) {

if($temp=='0'){

	$query = "update konfigurasi set userbca='".$user."',password='".base64_encode($pass)."',pmutasi=".$pmutasi.",email='".$email."',refresh=".$refresh."";
	mysql_query($query);

}else{

	$query = "update konfigurasi set userbca='".$user."',password='".base64_encode($pass)."',pmutasi=".$pmutasi.",email='".$email."',refresh=".$refresh."";
	mysql_query($query);

	$backup = "insert into tmp_detailbca select * from detailbca";
	mysql_query($backup);

	$hapus = "delete from detailbca";
	mysql_query($hapus);

	$data = "insert into detailbca select distinct * from tmp_detailbca where userbca = '".$user."'";
	mysql_query($data);

	$jml = "select distinct * from tmp_detailbca where userbca = '".$user."'";
	$hasil = mysql_query($jml);
	$jml = mysql_num_rows($hasil);
	
	$query1 = "update konfigurasi set jml1=".$jml.",jml2=".$jml."";
	mysql_query($query1);

	$tampung = "create table btmp select distinct * from tmp_detailbca";
	mysql_query($tampung);

	$tampung1 = "drop table tmp_detailbca";
	mysql_query($tampung1);

	$tampung2 = "rename table btmp to tmp_detailbca";
	mysql_query($tampung2);



}		 
 
}else {
 
  echo "Database Tidak Ada";
  mysql_close($connect_db);
 
}

 
?>
