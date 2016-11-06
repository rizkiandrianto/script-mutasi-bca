<?php

include 'db.php';

$connect_db=mysql_connect($host_name, $user_name, $password); 
$find_db=mysql_select_db($database);

$norek = '';
$nama = '';
$tgl = '';
$muang = '';
$saldo = '';
 
if ($find_db) {
 
 $query = "SELECT * FROM headerbca";
 $hasil = mysql_query($query);

 while ( $kolom_db = mysql_fetch_assoc($hasil) ) {
 
  $norek = $kolom_db['norek'];
  $nama = $kolom_db['nama'];
  $tgl = $kolom_db['tgl'];
  $muang = $kolom_db['muang'];
  $saldo = $kolom_db['saldo'];
 
 }
 
 // mysql_close($connect_db);
 
}else {
 
  echo "Database Tidak Ada";
 
  mysql_close($connect_db);
 
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/jquery.min.js"></script>
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/simplePagination.css" />
<script src="js/jquery.simplePagination.js"></script>
<title>Mutasi Rekening BCA</title>
<?php

 $counter = "SELECT refresh FROM konfigurasi";
 $hasilcounter = mysql_query($counter);
 
 while ( $kolom = mysql_fetch_assoc($hasilcounter) ) {
 
  $jml = $kolom['refresh'];
 
 }

?>
<script type="text/javascript">
var counter = <?php echo $jml;?>;
function countDown() {
    if(counter>=0) {
        document.getElementById("timer").innerHTML = counter;
    }
    else {
        download();
        return;
    }
    counter -= 1; 

    var counter2 = setTimeout("countDown()",1000);
    return;
}
function download() {
    //document.getElementById("link").innerHTML = "<a href='http://siunus.blogspot.com'>Download</a>";
	//location.reload();
	history.go(0);
}
</script>

</head>
<body onload="countDown();">
  <div class='container'>
    <!--<h1>Mutasi Rekening BCA</h1>-->

	<br>
    <div class='navbar navbar-inverse'>
      <div class='succes navbar-inner nav-collapse' style="height: auto;">
        <ul class="nav">
          <li><h3><font size="" color="white">Mutasi Rekening BCA</font></h3></li>
		  <!--
		  <li class="active"><a href="#">Home</a></li>
          <li><a href="#">Page One</a></li>
          <li><a href="#">Page Two</a></li>
		  -->
        </ul>
      </div>
    </div>

	<?php
	$connect_db=mysql_connect($host_name, $user_name, $password);
	$find_db=mysql_select_db($database);
	if ($find_db) {
	 
	 $query = "SELECT * FROM konfigurasi";
	 $hasil = mysql_query($query);
	 
	 while ( $kolom_db = mysql_fetch_assoc($hasil) ) {
	 
	  $userbca = $kolom_db['userbca'];
	  $pass = $kolom_db['password'];
	  $pmutasi = $kolom_db['pmutasi'];
	  $email = $kolom_db['email'];
	  $refresh = $kolom_db['refresh'];
	 
	 }
	 
	  mysql_close($connect_db);
	 
	}else {
	 
	  echo "Database Tidak Ada";
	  mysql_close($connect_db);
	 
	}

	$pass = base64_decode($pass);
	?>
	
    <div id='content' class='row-fluid'>
    <div class='span2 sidebar'>
        <h3></h3>
        <ul class="nav nav-tabs nav-stacked">
          <li><a href='#'>Dashboard</a></li>
          <li><a href='#' class="det"  
		  data-user="<?php echo $userbca?>"
		  data-password="<?php echo $pass?>"
		  data-pmutasi="<?php echo $pmutasi?>"
		  data-email="<?php echo $email?>"
		  data-refresh="<?php echo $refresh?>"
		  data-toggle="modal" data-target="#myModal">Konfigurasi</a></li>
        </ul>
      </div>
      <div class='span10 main'>
<pre>
Akun          : BCA
User BCA      : <?php echo $userbca; ?>

Rekening      : <?php echo $norek; ?>

Mata Uang     : <?php echo $muang; ?>

Saldo         : <?php echo $saldo; ?>

Refresh Web   : <span id="timer"></span> detik.
</pre>


				<?php

				$connect_db=mysql_connect($host_name, $user_name, $password);
				 
				$find_db=mysql_select_db($database);
 
				if ($find_db) {
				 
				 
 				//pagging
				$per_hal=20;
				$jumlah_record=mysql_query("SELECT COUNT(*) from detailbca");
				$jum=mysql_result($jumlah_record, 0);
				$halaman=ceil($jum / $per_hal);
				$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
				$start = ($page - 1) * $per_hal;

				 
				 $query = "SELECT DISTINCT RIGHT(STR_TO_DATE(tgl,'%d/%m'),5) tgl,ket,mutasi,mkode FROM detailbca ORDER BY tgl DESC limit $start, $per_hal;";
				 $hasil = mysql_query($query);
				 
				 ?>				 

            <table class="table table-striped table-condensed">
                  <thead>
                  <tr>
                      <th width="8%"><center>Tanggal</center></th>
                      <th width="60%">Keterangan</th>
                      <th width="5%">Cab</th>
					  <th width="5%">Jenis</th>
                      <th width="10%">Saldo Mutasi</th>                                          
                  </tr>
              </thead>   
              <tbody>
               
				<?php
				 while ( $kolom_db = mysql_fetch_assoc($hasil) ) {
				?> 
				
				<tr>
                    <td><center><?php echo $kolom_db['tgl']; ?></center></td>
                    <td><?php echo substr($kolom_db['ket'],0,-4); ?></td>
                    <td><?php echo substr($kolom_db['ket'],-4); ?></td>
					<td><?php echo $kolom_db['mkode']; ?></td>
                    <td><span class="label label-<?php if($kolom_db['mkode'] == 'DB'){ echo 'important'; } else { echo 'success';} ?>"><?php echo $kolom_db['mutasi']; ?></span>
                    </td>                                       
                </tr>
				 
				<?php
				 }				 
				  mysql_close($connect_db);
				?>


				                              
              </tbody>
            </table>
					<hr>
					Halaman :
					<?php
					for($x=1;$x<=$halaman;$x++){
						?>
						<a href="?page=<?php echo $x ?>" class="btn btn-success"><?php echo $x ?></a>
						<?php
					}
					?>

				<?php 

				}else {
				 
				  echo "Database Tidak Ada";
				 
				  mysql_close($connect_db);
				 
				}
				 
				?>
      
	  </div>


	  <!-- Modal -->
	  <div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog modal-sm">
		  <div class="modal-content">
			<div class="modal-header label-success">
			  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  <h4 class="modal-title">Konfigurasi BCA</h4>
			</div>
			<div class="modal-body">
<pre>
User Bca     : <input type="text" class="span4" id="user" name="user" maxlength="12"></input><input type="hidden" class="span4" id="tmpuser" name="tmpuser"></input>
Password     : <input type="password" class="span3" name="pass" id="pass" maxlength="6"></input>
Ambil Mutasi : <input type="text" class="span1" id="pmutasi" name="pmutasi" maxlength="2"></input> hari mulai dari tanggal sekarang.
Alamat email : <input type="text" class="span5" id="email" name="email"></input>
Refresh Web  : <input type="text" class="span2" id="refresh" name="refresh" maxlength="4"></input> detik.
</pre>
			</div>
			<div class="modal-footer">
			  <a href="#" class="simpan btn btn-success">Simpan</a>
			  <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
			</div>
		  </div>
		</div>
	  </div>
					
	  <div class="container">
      <!--
	  <div class='span2 sidebar'>
        <h3>Right Sidebar</h3>
        <ul class="nav nav-tabs nav-stacked">
          <li><a href='#'>Another Link 1</a></li>
          <li><a href='#'>Another Link 2</a></li>
          <li><a href='#'>Another Link 3</a></li>
        </ul>
      </div>
	  -->
    </div>
  </div>


  <script src="js/bootstrap.js"></script>

	<script type="text/javascript">
	$(document).on("click", ".det", function () {
		 var myUser = $(this).data('user');
		 var myPass = $(this).data('password');
		 var myPmutasi = $(this).data('pmutasi');
		 var myEmail = $(this).data('email');
		 var myRefresh = $(this).data('refresh');
	     var myTmpuser = $(this).data('user');
		 $(".modal-body #user").val( myUser );
		 $(".modal-body #pass").val( myPass );
		 $(".modal-body #pmutasi").val( myPmutasi );
		 $(".modal-body #email").val( myEmail );
		 $(".modal-body #refresh").val( myRefresh );
		 $(".modal-body #tmpuser").val( myTmpuser );
	});

	$(document).on("click", ".simpan", function () {
		var url = "update.data.php";
		
		var v_user = $('input:text[name=user]').val();
		var v_pass = $('input:password[name=pass]').val();
		var v_pmutasi = $('input:text[name=pmutasi]').val();
		var v_email = $('input:text[name=email]').val();
		var v_refresh = $('input:text[name=refresh]').val();
		var v_tmpuser = $('input:hidden[name=tmpuser]').val();

		if (v_user != v_tmpuser)
		{
			
			var v_tmp = 1;
			
			if (v_pmutasi > 30)
			{
				alert('Ambil mutasi tidak boleh melebihi tanggal 30');
				return true;
			}
			if (v_pmutasi < 1)
			{
				alert('Ambil mutasi tidak boleh kurang dari 1');
				return true;
			}
			if (v_refresh < 60)
			{
				alert('Time refresh tidak boleh di set kurang dari 60 detik.');
				return true;
			}

			var answer = confirm("Merubah User berarti kembali ke settingan default dan akan membackup data user sebelumnya");
			if (answer) {
				$.post(url, {user: v_user, pass: v_pass, pmutasi: v_pmutasi, email: v_email, refresh: v_refresh, tmp: v_tmp, tmpuser: v_tmpuser} ,function() {
					$('#myModal').modal('hide');
					window.location.reload();
				});
			}

			//alert('Merubah User berarti kembali ke settingan default');	

		}else{
			
			var v_tmp = 0;
			
			if (v_pmutasi > 30)
			{
				alert('Ambil mutasi tidak boleh melebihi tanggal 30');
				return true;
			}
			if (v_pmutasi < 1)
			{
				alert('Ambil mutasi tidak boleh kurang dari 1');
				return true;
			}
			if (v_refresh < 60)
			{
				alert('Time refresh tidak boleh di set kurang dari 60 detik.');
				return true;
			}

			var answer = confirm("Apakah anda ingin memproses data ini?");
			if (answer) {
				$.post(url, {user: v_user, pass: v_pass, pmutasi: v_pmutasi, email: v_email, refresh: v_refresh, tmp: v_tmp, tmpuser: v_tmpuser} ,function() {
					$('#myModal').modal('hide');
					window.location.reload();
				});
			}

		}
	});
	</script>

</body>
</html>