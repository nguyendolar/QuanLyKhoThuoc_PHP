<!DOCTYPE html>
<html lang="en">

<head>
<?php include('inc/head.php')?>
</head>

<body class="sb-nav-fixed">
<?php include('inc/header.php')?>
    <div id="layoutSidenav">
    <?php include('inc/menu.php')?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
               
                    <h1 class="mt-4">Danh sách phiếu xuất kho</h1>
                    <div class="card mb-4">
                    <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
                            <div class="card-header">
                       
                       <button type="button" class="btn btn-success" data-bs-toggle="modal"
                           data-bs-target="#exampleModalAdd">
                           Thêm mới
                       </button>
                   </div>
                        <div class="card-body">
                        
                            <table id="datatablesSimple">
                                <thead>
                                <tr style="background-color : #6D6D6D">
                                        <th>STT</th>
                                        <th>Mã phiếu</th>
                                        <th>Thùng</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng xuất</th>
                                        <th>Giá xuất</th>
                                        <th>Thành tiền</th>
                                        <th>Ngày xuất</th>
                                        <th>Người xuất</th>
                                        <th>Vị trí xuất</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $query = "SELECT a.*, b.tenthung, c.ten, d.hoten
                                    FROM phieuxuatkho as a,thung as b, sanpham as c, nguoidung as d
                                     WHERE a.thung_id = b.id 
                                     AND b.sanpham_id = c.id
                                     AND a.nguoidung_id = d.id
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["maphieu"] ?></td>
                                        <td><?php echo $arUser["tenthung"] ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td><?php echo $arUser["soluong"] ?></td>
                                        <td><?php echo number_format($arUser['gia']) ?></td>
                                        <td><?php echo number_format($arUser['thanhtien']) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngayxuat"])) ?> </td>
                                        <td><?php echo $arUser["hoten"] ?></td>
                                        <td>Kệ <?php echo $arUser["ke"] ?> Hàng <?php echo $arUser["hang"] ?> Ô <?php echo $arUser["o"] ?></td>

                                    </tr>
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xuất hàng</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="col">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Mã phiếu:</label>
                                                                <input type="text" class="form-control" id="category-film" name="maphieu" required>
                                                        </div>
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <label for="category-film"
                                                                class="col-form-label">Thùng sản phẩm:</label>
                                                        <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="thungsp" required>
                                                                    <option value="" selected>Chọn thùng sản phẩm</option>
                                                                    <?php
                                                                     $lsp = mysqli_query($connect, "SELECT a.*, b.ten FROM thung as a,sanpham as b WHERE a.sanpham_id = b.id AND a.soluongthung != 0 ORDER BY a.ngayhethan ASC");
                                                                     while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <option value="<?php echo $arLsp['id'] ?>" ><?php echo $arLsp['tenthung'] ?>( <?php echo $arLsp['ten'] ?>)</option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Số lượng xuất:</label>
                                                                <input type="number" value="50" class="form-control" id="category-film" name="soluong" readonly>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-12">
                                                            <label for="category-film"
                                                                class="col-form-label">Giá xuất:</label>
                                                                <input type="number" min="0" class="form-control" id="category-film" name="gia" required>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addxh">Lưu </button>
                                                </div>
                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Update-->
                                    

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <?php include('inc/footer.php')?>
        </div>
    </div>
    <script>
    CKEDITOR.replace("editor");
    </script>
    <script>
for (var i = 1; i < 200; i++) {
    var name = "editor" + i
    CKEDITOR.replace(name);

}

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>