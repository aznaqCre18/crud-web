<?php

    require './config/functions.php';

    //cek apakah button submit sudah diklick atau belum
    if(isset($_POST["submit"])) {

        if(tambah($_POST) > 0) {
            echo "
                <script>
                    alert('Data berhasil ditambahkan!');
                    window.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Data gagal ditambahkan!');
                </script>
            ";
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="shortcut icon" href="./static/icon/motor.png" type="image/x-icon">
    <title>Insert Data</title>
  </head>
  <body>
    <div class="container">
        <h2 class="insert-title">Insert Data Sepeda Motor</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" name="model" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Model</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="merek" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Brand</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="harga" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Price</label>
            </div>
            <div class="input-group mb-3">
                <input type="file" name="image" class="form-control" id="inputGroupFile01">
            </div>
            <div class="btn-group-cust">
                <button type="submit" name="submit" class="btn-cust btn btn-success btn-m"><i class="bi bi-pencil-square"></i><span class="btn-text-cust">Insert Data</span></button>
            </div>
        </form>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>