<?php

require './config/functions.php';

$sepeda_motor = query("SELECT * FROM sepeda_motor");

if(isset($_POST['update'])) {

    if(update($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil diupdate!');
                window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal diupdate!');
                window.location.href = 'index.php';
            </script>
        ";
    }
}

if(isset($_POST['delete'])) {
    if(delete($_POST) > 0) {
        echo "
            <script>
                alert('Data berhasil dihapus!');
                window.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data gagal dihapus!');
                window.location.href = 'index.php';
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
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="./static/icon/motor.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Data Sepeda Motor</title>
</head>

<body>
    <div class="container">
        <h2>Data Sepeda Motor</h2>
        <div class="table-container">
            <a href="./insert-data.php" type="button" class="btn-cust btn btn-primary btn-sm"><i class="bi bi-plus-square-fill"></i><span class="btn-text-cust">Tambah Data Sepeda Motor</span></a>
            <?php if($sepeda_motor) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Model</th>
                            <th scope="col">Picture</th>
                            <th scope="col">Brand</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($sepeda_motor as $row) : ?>
                            <tr class="row-table">
                                <td scope="row"><?= $i ?></td>
                                <td><?php echo $row['model'] ?></td>
                                <td><img src="./img/<?= $row['image']?>"  width="100" height="100" style="border-radius: 4px;" class="motor-img" alt="Sepeda motr pict"></td>
                                <td><?php echo $row['merek'] ?></td>
                                <td><?= idrCurrency($row['harga']) ?></td>
                                <td style="display: none;"><?= $row['harga'] ?></td>
                                <td class="edit-view">
                                    <a 
                                        type="button" 
                                        id="btnEditModal"
                                        class="btn-cust btn btn-warning btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="<?= $row['id'] ?>"
                                        data-model="<?= $row['model'] ?>"
                                        data-brand="<?= $row['merek'] ?>"
                                        data-price="<?= $row['harga'] ?>"
                                        data-image="<?= $row['image'] ?>"
                                    >
                                        <i class="bi bi-pencil-square"></i>
                                        <span class="btn-text-cust">Edit</span>
                                    </a>
                                    <a 
                                        type="button" 
                                        id="btnDeleteModal" 
                                        class="btn-cust btn btn-danger btn-sm"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal" 
                                        data-id="<?= $row['id'] ?>"
                                        data-image="<?= $row['image'] ?>"
                                    >
                                        <i class="bi bi-trash-fill"></i>
                                        <span class="btn-text-cust">Delete</span>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                        <?php endforeach ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="empty-table"><p>Tidak ada data motor ditemukan</p></div>
            <?php endif ?>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <input type="hidden" name="oldImage" id="old-image">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Model</label>
                            <input type="text" name="model" id="model" class="form-control" id="formGroupExampleInput" placeholder="Model of the motorcycle">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control" id="formGroupExampleInput2" placeholder="Brand of the motorcycle">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Price</label>
                            <input type="text" name="price" id="price" class="form-control" id="formGroupExampleInput2" placeholder="Price of the motorcycle">
                        </div>
                        <div class="img-wrapper" style="display: flex; justify-content: center; border: 1px solid; border-radius: 10px; width: 132px; padding: 16px 0; margin-bottom: 20px;">
                            <img width="100" height="100" id="image-update" style="border-radius: 4px;" class="motor-img" alt="Sepeda motr pict">
                        </div>
                        <div class="input-group mb-3">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <h6>Are you sure want to delete this data ?</h6>
                        <input type="hidden" name="id" id="id-delete">
                        <input type="hidden" name="image" id="image-delete">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).on('click', '#btnEditModal', function() {
            let id = $(this).data('id');
            let model = $(this).data('model');
            let brand = $(this).data('brand');
            let price = $(this).data('price');
            let image = $(this).data('image');

            let imagePath = `img/${image}`;
            
            $('.modal-body #edit-id').val(id);
            $('.modal-body #old-image').val(image);
            $('.modal-body #model').val(model);
            $('.modal-body #brand').val(brand);
            $('.modal-body #price').val(price);
            $('.modal-body #image-update').attr("src", imagePath);
        })

        $(document).on('click', '#btnDeleteModal', function() {
            let id = $(this).data('id');
            let image = $(this).data('image');

            $('.modal-body #id-delete').val(id);
            $('.modal-body #image-delete').val(`img/${image}`);
        })

    </script>

    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>