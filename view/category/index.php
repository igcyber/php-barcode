<?php
    include_once("../../config/database.php");

    session_start();

    if($_SESSION['username'] == ""){
      header('location:../index.php');
    }

    if(isset($_POST['submit'])){
      $kat_name = $_POST['kategori'];
      if(empty($kat_name)){
        echo "<script> alert('Nama Kategori Tidak Boleh Kosong')</script>";
      }
      else
      {
        $insert = $pdo->prepare("INSERT INTO tb_category (name) value(:name)");
        $insert->bindParam(':name',$kat_name);
      
        if($insert->execute()){
          echo "<script> alert('Data Berhasil Ditambah')</script>";
        }else{
          echo "<script> alert('Data Tidak Berhasil Ditambah')</script>";
        }

      }
    }
?>

<?php
    include_once("../inc/header.php");
    include_once("../inc/admin_sidebar.php");    
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Seluruh Kategori</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Kategori</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $no = 1;
                      $sql = "SELECT * FROM tb_category";
                      $stmt  = $pdo->query($sql);
                      while($row = $stmt->fetch()){
                          $id = $row["id"];
                          $cat = $row["name"];
                    ?>
                    <tr>
                      <td>
                        <?= $no++ ?>
                      </td>
                      <td>
                        <?= $cat ?>
                      </td>
                      <td>
                        <a href="update.php?id=<?= $id; ?>" class="btn btn-info btn-sm">Edit</a>
                        <a href="delete.php?id=<?= $id; ?>" class="btn btn-danger btn-sm">Hapus</a>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- col form -->
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Kategori</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                <div class="card-body">
                  <div class="form-group">
                    <label for="katInput">Nama Kategori</label>
                    <input type="text" class="form-control" id="katInput" name="kategori">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- col form -->

        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php
    include_once("../inc/footer.php");
?>




