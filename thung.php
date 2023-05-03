
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
                    <h1 class="mt-4">Danh sách thùng</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                        <?php if (isset($_GET['msg'])){
                            if($_GET['msg'] == 1){ ?>
                             <div class="alert alert-success">
                                <strong>Thành công</strong>
                            </div>
                            <?php }  ?> 
                            <?php }  ?>   
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
                                        <th>Tên thùng</th>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng thùng</th>
                                        <th>Số lượng sản phẩm mỗi thùng</th>
                                        <th>Tổng sản phẩm</th>
                                        <th>Ngày sản xuất</th>
                                        <th>Ngày hết hạn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    $query = "SELECT a.*,b.ten 
                                    FROM thung as a,sanpham as b
                                     WHERE a.sanpham_id = b.id 
                                     ORDER BY a.id DESC";
                                    $result = mysqli_query($connect, $query);
                                    $stt = 1;
                                    while ($arUser = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $stt ?></td>
                                        <td><?php echo $arUser["tenthung"] ?></td>
                                        <td><?php echo $arUser["ten"] ?></td>
                                        <td><?php echo $arUser["soluongthung"] ?></td>
                                        <td><?php echo $arUser["soluongsanpham"] ?></td>
                                        <td><?php echo ( $arUser["soluongthung"] * $arUser["soluongsanpham"]) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngaysanxuat"])) ?> </td>
                                        <td><?php echo date("d-m-Y", strtotime($arUser["ngayhethan"])) ?> </td>
                                    </tr>
                                    <?php $stt++;} ?>
                                    <!-- Modal Add-->
                                    <div class="modal fade" id="exampleModalAdd" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm mới</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="function.php" method="POST" enctype="multipart/form-data">
                                                    <div class="col">
                                                        <div class="row">
                                                        
                                                        <div class="col-12">
                                                        <label for="category-film"
                                                                class="col-form-label">Sản phẩm:</label>
                                                                <select class="form-select" aria-label="Default select example" id="theloai" tabindex="8" name="sp" required>
                                                                    <option value="" selected>Chọn sản phẩm</option>
                                                                    <?php
                                                                     $lsp = mysqli_query($connect, "SELECT * FROM sanpham");
                                                                     while ($arLsp = mysqli_fetch_array($lsp, MYSQLI_ASSOC)) {
                                                                    ?>
                                                                    <option value="<?php echo $arLsp['id'] ?>" ><?php echo $arLsp['ten'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Tên thùng:</label>
                                                                <input type="text" class="form-control" id="category-film" name="ten" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Số lượng sản phẩm</label>
                                                                <input type="number" class="form-control" id="category-film" name="slsp" min="1" required>
                                                        </div>
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày sản xuất:</label>
                                                                <input type="date" class="form-control" id="category-film" name="nsx" required>
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="category-film"
                                                                class="col-form-label">Ngày hết hạn:</label>
                                                                <input type="date" class="form-control" id="category-film" name="nhh" required>
                                                        </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <button type="submit" class="btn btn-primary" name="addt">Lưu</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

</html>