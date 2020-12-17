<?php
require 'function.php';

if($_FILES['image']){
    $data = base64_encode(file_get_contents( $_FILES["image"]["tmp_name"] ));
    $base64_string = "data:".getimagesize($_FILES["image"]["tmp_name"])["mime"].";base64,".$data;
}
else{
    $base64_string = $_POST['image'];
}

$username = $_POST['idUser'];
$password = md5($_POST["password"]) ;
// echo "SELECT * INTO user WHERE idUser = '$username' AND pwd = '$password'";

$data = query("SELECT * FROM user WHERE idUser = '$username' AND pwd = '$password'");
if(!$data){
    $m=array('msg' => "REJECTED, username atau password salah");
    echo json_encode($m);
    return;}

$image_name = "C:\\xampp\\htdocs\\quiz_pweb\\uploadFace\\".$username;
$base = $base64_string;

if (!file_exists($image_name)) {
 if (!mkdir($image_name)) {
    $m=array('msg' => "REJECTED, cant create folder");
    echo json_encode($m);
    return;}
}

$path = explode('/', $base);
$extension = explode(';', $path[1])[0];

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi)+1;
$data = explode(',', $base64_string);
$name_file = "X__".$fileCount."_". date("YmdHis") .".".$extension;
$fullName = $image_name."\\".$name_file;
$ifp = fopen($fullName, "wb");
fwrite($ifp, base64_decode($data[1]));
fclose($ifp);
if (!$ifp){
    $m=array('msg' => "REJECTED, ".$fullName."not saved");
    echo json_encode($m);
    return;}

// $command = escapeshellcmd("python checkFace.py ".$fullName);
// $output = shell_exec($command);

$fi = new FilesystemIterator($image_name, FilesystemIterator::SKIP_DOTS);
$fileCount = iterator_count($fi);
$date = new DateTime(null, new DateTimeZone('Asia/Jakarta'));
$tanggal = $date->format('Y-m-d H:i:s');

$result = tambah("INSERT INTO log value (NULL,'$username','$name_file','$tanggal')");
if($result != 1){
    $m = array('msg' => "gagal membuat log");
    echo json_encode($m);
    return;
}   

$m = array('msg' => "Berhasil Mengirim"." total(".$fileCount.")");
echo json_encode($m);

?>
