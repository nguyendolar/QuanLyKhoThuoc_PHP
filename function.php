<?php
include('inc/connect.php');
$idnd = $_SESSION['id'];
//Thùng
if(isset($_POST['addt'])){
    $ten = $_POST['ten'];
    $sp  = $_POST['sp'];
    $slsp = $_POST['slsp'];
    $nsx = $_POST['nsx'];
    $nhh = $_POST['nhh'];
    $query = "INSERT INTO thung ( tenthung, sanpham_id, soluongsanpham, ngaysanxuat, ngayhethan) 
    VALUES ( '{$ten}', '{$sp}', '{$slsp}', '{$nsx}', '{$nhh}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: thung.php?msg=1");
    } 
    else {
        header("Location: thung.php?msg=2");
    }
}
//Sản phẩm
if(isset($_POST['addsp'])){
    $ten = $_POST['ten'];
    $nhacungcap  = $_POST['nhacungcap'];
    //Upload ảnh
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_parts =explode('.',$_FILES['image']['name']);
    $file_ext=strtolower(end($file_parts));
    $expensions= array("jpeg","jpg","png");
    $image = $_FILES['image']['name'];
    $target = "./image/".basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $query = "INSERT INTO sanpham ( ten, anh, nhacungcap) 
    VALUES ( '{$ten}', '{$image}', '{$nhacungcap}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: sanpham.php?msg=1");
    } 
    else {
        header("Location: sanpham.php?msg=2");
    }
}
//Nhập hàng
if(isset($_POST['addnh'])){
    $thungsp = $_POST['thungsp'];
    $soluong = $_POST['soluong'];
    // lấy thứ tự hiện tại trong kho
    $querylm = mysqli_query($connect, "Select * From phieunhapkho ORDER by id desc LIMIT 1");
    $row = mysqli_fetch_array($querylm);
    $ohientai = $row["o"];
    if (empty($ohientai)){
      $ke = 1;
      $hang = 1;
      $o = 1;
    }
    else{
      //Tính toán
      if($ohientai == 10){
        $hanghientai = $row["hang"];
        if($hanghientai == 4){
          $ke = $row["ke"] + 1;
          $hang = 1;
          $o = 1;
        }
        else{
          $ke = $row["ke"];
          $hang = $row["hang"] + 1;
          $o = 1;
        }
      }
      else{
          $ke = $row["ke"];
          $hang = $row["hang"];
          $o = $row["o"] + 1;
      }
    }
    //
    $query = "INSERT INTO phieunhapkho (thung_id, soluong, ke, hang, o) 
    VALUES ( '{$thungsp}', '{$soluong}', '{$ke}', '{$hang}', '{$o}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      $update = "UPDATE `thung` 
      SET `soluongthung`= soluongthung + '{$soluong}'
      WHERE `id`='{$thungsp}'";
      $resultud = mysqli_query($connect, $update);
      header("Location: nhaphang.php?msg=1");
    } 
    else {
        header("Location: nhaphang.php?msg=2");
    }
}
//Xuất hàng
if(isset($_POST['addxh'])){
    $thungsp = $_POST['thungsp'];
    $soluong = $_POST['soluong'];
    //
    // lấy thứ tự hiện tại trong kho
    $querylm = mysqli_query($connect, "SELECT * FROM phieunhapkho WHERE thung_id ='{$thungsp}' AND trangthai = 0 LIMIT 1");
    $row = mysqli_fetch_array($querylm);
    $idnhapkhohientai = $row["id"];
    $o = $row["o"];
    $ke = $row["ke"];
    $hang = $row["hang"];
    //
    $query = "INSERT INTO phieuxuatkho (thung_id, soluong, ke, hang, o) 
    VALUES ( '{$thungsp}', '{$soluong}', '{$ke}', '{$hang}', '{$o}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      $updatenk = "UPDATE `phieunhapkho` 
      SET trangthai = 1
      WHERE `id`='{$idnhapkhohientai}'";
      $resultudnk = mysqli_query($connect, $updatenk);
      $update = "UPDATE `thung` 
      SET `soluongthung`= soluongthung - '{$soluong}'
      WHERE `id`='{$thungsp}'";
      $resultud = mysqli_query($connect, $update);
      header("Location: xuathang.php?msg=1");
    } 
    else {
        header("Location: xuathang.php?msg=2");
    }
    
}

//Nhân viên
if(isset($_POST['addnv'])){
    $hoten = $_POST['hoten'];
    $email  = $_POST['email'];
    $sdt = $_POST['sdt'];
    $gioitinh = $_POST['gioitinh'];
    $ngaysinh = $_POST['ngaysinh'];
    $diachi = $_POST['diachi'];
    $query = "INSERT INTO nhanvien ( hoten, email, sodienthoai, ngaysinh, gioitinh, diachi) 
    VALUES ( '{$hoten}', '{$email}', '{$sdt}', '{$ngaysinh}', '{$gioitinh}', '{$diachi}') ";
    $result = mysqli_query($connect, $query);
    if ($result) {
      header("Location: nhanvien.php?msg=1");
    } 
    else {
        header("Location: nhanvien.php?msg=2");
    }
}
?>
 