<?php 
// koneksi ke mysql
function conn_mysql(){
  return mysqli_connect("localhost","root","","quiz_pweb");
}

// mengambil satu-satu query di masukan ke array
function query($query){
  $conn = conn_mysql();
  $result = mysqli_query($conn,$query);

  $rows=[];
  while($row = mysqli_fetch_assoc($result)){
    $rows[]=$row;
  }

  close();
  return $rows;
}

function tambah($query){
  $conn = conn_mysql();

  mysqli_query($conn,$query);
  $cek = mysqli_affected_rows($conn);
  close();
  return $cek;
}

function close(){
  mysqli_close(mysqli_connect("localhost","root","","quiz_pweb"));
}