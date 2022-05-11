<?php
require 'ceklogin.php';

if(isset($_GET['idp'])){
    $idp = $_GET['idp'];


    $ambilnamapelanggan = mysqli_query($c,"select * from pesanan p, pelanggan pl where p.idpelanggan=pl.idpelanggan and p.idorder='$idp'");
    $np = mysqli_fetch_array($ambilnamapelanggan);
    $namapel = $np['namapelanggan'];
}else{
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Data Pesanan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
       
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Aplikasi Kasir</a>
            <!-- Sidebar Toggle-->
            
        </nav>
        <div id="layoutSidenav">
        </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                    <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <br>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pesanan: <?=$idp;?></h1>
                        <h2 class="mt-4">Nama Pelanggan: <?=$namapel;?></h2>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Selamat Datang</li>
                        </ol>
                        <button type="button" class="btn btn-info mb-4" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambah Barang
                        </button>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Data Pesanan
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Sub-total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $get = mysqli_query($c,"select * from detailpesanan p, produk pr where p.idproduk=pr.idproduk and idpesanan='$idp'");
                                    $i = 1;


                                    while($p=mysqli_fetch_array($get)){
                                    $idpr = $p['idproduk'];
                                    $iddp = $p['iddetailpesanan'];
                                    $qty = $p['qty'];
                                    $harga = $p['harga'];
                                    $namaproduk = $p['namaproduk'];
                                    $desc = $p['deskripsi'];
                                    $subtotal = $qty*$harga;
                                    ?>

                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$namaproduk;?>  (<?=$desc;?>)</td>
                                            <td>Rp<?=number_format($harga);?></td>
                                            <td><?=number_format($qty);?></td>
                                            <td>Rp<?=number_format($subtotal);?></td>
                                            <td>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?=$idpr;?>">
                                                Edit
                                            </button>                     
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?=$idpr;?>">
                                                Hapus
                                            </button>
                                            </td>
                                            </tr>

                                                    <!-- Modal edit -->
                                         <div class="modal fade" id="edit<?=$idpr;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Ubah Data Detail Pesanan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="post">

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <input type="text" name="namaproduk" class="form-control" placeholder="Nama Produk" value="<?=$namaproduk;?>: <?=$desc;?>" disabled>
                                                <input type="number" name="qty" class="form-control mt-2" placeholder="Harga Produk" value="<?=$qty;?>">
                                                <input type="hidden" name="iddp" value="<?=$iddp;?>">
                                                <input type="hidden" name="idp" value="<?=$idp;?>">
                                                <input type="hidden" name="idpr" value="<?=$idpr;?>">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="editdetailpesanan">Submit</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            
                                            </form>

                                            </div>
                                        </div>
                                        </div>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="delete<?=$idpr;?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Apakah Anda yakin ingin menghapus barang ini?</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <form method="post">

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus barang ini?
                                                    <input type="hidden" name="idp" value="<?=$iddp;?>"> 
                                                    <input type="hidden" name="idpr" value="<?=$idpr;?>">
                                                    <input type="hidden" name="idorder" value="<?=$idp;?>">
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" name="hapusprodukpesanan">Ya</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>
                                                
                                                </form>

                                                </div>
                                            </div>
                                            </div>

                                    <?php 
                                    };
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <form method="post">

      <!-- Modal body -->
      <div class="modal-body">
        pilih Barang
        <select name="idproduk" class="form-control" id="barcode">
        <?php 
        $getproduk = mysqli_query($c,"select * from produk where idproduk not in (select idproduk from detailpesanan where idpesanan='$idp')");

        while($pl=mysqli_fetch_array($getproduk)){
            $namaproduk = $pl['namaproduk'];
            $stock = $pl['stock'];
            $deskripsi = $pl['deskripsi'];
            $idproduk = $pl['idproduk'];
        ?>

        <option value="<?=$idproduk;?>"><?=$namaproduk;?> - <?=$deskripsi;?> (Stock: <?=$stock;?>)</option>


        <?php 
        }
        ?>
        </select>

        <input type="number" name="qty" class="form-control mt-4" placeholder="jumlah" min="1" required>
        <input type="hidden" name="idp" value="<?=$idp;?>">
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="addproduk">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
      
      </form>

    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>$(document).ready(function() {
    $('#barcode').select2();
});</script>

</html>
