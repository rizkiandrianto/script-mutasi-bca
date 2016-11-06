# script-mutasi-bca

Untuk password Mutasi_BCA : mbca123.

1. Extract file Mutasi_BCA.zip 
2. Setelah di extract akan ada folder UniServerz
3. Copy kan folder UniServerZ ke drive D:\ atau C:\
4. Jika Komputer sudah terinstal Xampp atau Wampp matikan dulu service nya. (Mysql dan Apache). Lebih baik Uninstal saja.
5. Masuk ke folder UniserverZ dan klik UniController.exe
6. Start service apache dan mysql tunggu beberapa saat sampai icon merah berubah menjadi hijau, itu berarti service mysql dan apache sudah berjalan.
7. Buka Browser diusahakan memakai Google Chrome aga bisa berjalan normal
8. buka url http:\\localhost\bca maka akan muncul tampilan di "gambar 1.jpg" dan pengaturannya di "gambar 2.png"
9. untuk pengaturan sangat simple cuma masukkan user, password, periode mutasi max 30 hari, alamat email dan refresh halaman mutasi min 60 detik
10. Data mutasi akan terambil setelah 20 menit berjalan, karena memang sudah saya setting 20 menit (CronJob) di UniServerZ nya. Ini hanya optional, bisa disetting sendiri sesuka anda.
11. Selesai

* UniServerZ sudah support Cron Job.
* Untuk Settingan UniServerZ nya bisa langsung ke web nya: http://www.uniformserver.com/ atau http://wiki.uniformserver.com/index.php/Main_Page

Untuk tutorial offline UniserverZ nya bisa di lihat di folder UniServerZ\docs\manual  
apabila di copy di drive C:\ maka file nya ada di C:\UniServerZ\docs\manual. File berupa html

## Cronjob

1. Masuk Ke Akun cPanel Kalian Masing-Masing
2. Klik Cron Jobs
3. Isi ''Common Setting'' Dengan Waktu Yang Di Ingginkan
4. Pada Command Isi Dengan :
"php -q /home/user_name_anda/public_html/nama_file.php"
.
Contoh : Apabila Nama File Kita Robot.php Maka Kita Setting :"php -q /home/user_name_anda/public_html/robot.php"
.
Nb : Tanpa Tanda "

Disclaimer:
Script ini bukan milik saya, Saya membelinya dr tokopedia untung kepentingan research pribadi. Credit sepenuhnya untuk mas di tokopedia yg membuat ini (saya lupa namanya).
