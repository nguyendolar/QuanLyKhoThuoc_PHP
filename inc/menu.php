
<div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Trang chủ
                        </a>
                        <?php if($_SESSION['quyen'] == 1){ ?>
                        <a class="nav-link" href="nhanvien.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Nhân viên
                        </a>
                        <?php } ?>
                        <a class="nav-link" href="sanpham.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Sản phẩm
                        </a>
                        <a class="nav-link" href="thung.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Thùng sản phẩm
                        </a>
                        <a class="nav-link" href="nhaphang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Phiếu nhập hàng
                        </a>
                        <a class="nav-link" href="xuathang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Phiếu xuất hàng
                        </a>
                    </div>
                </div>
            </nav>
        </div>