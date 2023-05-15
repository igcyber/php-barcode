<?php
    include_once("../../config/database.php");

    session_start();

    if($_SESSION['username'] == ""){
      header('location:../../index.php');
    }

    $queryId = $_GET["id"];

    include_once("../inc/header.php");

    if(isset($_POST["update"])){
        $category = $_POST["kategori"];

        $sql = "UPDATE tb_category SET name='$category'
        WHERE id='$queryId'";
        $result = $pdo->query($sql);        
        
        if($result)
        {
            echo "<script> alert('Data Berhasil Diperbarui')</script>";
        }else{
            echo "<script> alert('Data Tidak Dapat Diperbarui')</script>";
        }
    }



?>
<?php
  include_once("../inc/admin_sidebar.php");
?>

<div class="content-wrapper">
    <?php
        $sql = "SELECT * FROM tb_category WHERE id='$queryId'";
        $stmt = $pdo->query($sql);
        while($rows = $stmt->fetch()){
            $data_nama = $rows["name"];
        }
    ?>
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
        <!-- col form -->
            <div class="col-md-6 mx-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title"> Kategori</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="">
                    <div class="card-body">
                        <div class="form-group">
                        <label for="katInput">Nama Kategori</label>
                        <input type="text" class="form-control" id="katInput" name="kategori" value="<?= $data_nama?>">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" name="update" class="btn btn-primary">Perbarui</button>
                        <a href="index.php" class="btn btn-info">Kembali</a>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- col form -->
        </div>

      </div>

    </section>

</div>



<?php
    include_once("../inc/footer.php");
?>