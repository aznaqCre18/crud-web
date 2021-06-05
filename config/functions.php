<?php

$conn = mysqli_connect("localhost", "root", "", "tugas_web_dua");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $row = [];
    // $rows = [];

    while ($row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data) {
    global $conn;

    $model = htmlspecialchars($data['model']);
    $merek = htmlspecialchars($data['merek']);
    $harga = htmlspecialchars($data['harga']);

    //upload
    $uploadImage = upload();
    if(!$uploadImage) {
        return false;
    }

    $query = "INSERT INTO sepeda_motor VALUES ('', '$model', '$uploadImage', '$merek', '$harga')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload() {
    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    //cek apakah ada gambar yg diupload atau tidak
    if($error === 4) {
        echo "
            <script>
                alert('Tidak ada gambar yang diuplaod!');
            </script>
        ";
        return false;
    }

    //cek apakah yang diupload gambar atau bukan
    $fileValid = ['jpg', 'jpeg', 'png'];
    $ekstensiFile = explode('.', $namaFile);
    $ekstensiFile = end($ekstensiFile);
    $ekstensiFile = strtolower($ekstensiFile);
    if(!in_array($ekstensiFile, $fileValid)) {
        echo "
            <script>
                alert('Harap masukan gambar bukan file lain!');
            </script>
        ";
        return false;
        // die;
    }

    //cek apakah size image too big
    if($ukuranFile > 1000000) {
        echo "
            <script>
                alert('Ukuran gambar terlalu besar');
            </script>
        ";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiFile;

    //passed cheking
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
};

function update($data) {
    global $conn;

    $id = htmlspecialchars($data['id']);
    $model = htmlspecialchars($data['model']);
    $merek = htmlspecialchars($data['brand']);
    $harga = htmlspecialchars($data['price']);
    $oldImage = htmlspecialchars($data['oldImage']);

    // cek apakah user memilih gambar atau tidak
    if($_FILES['image']['error'] === 4) {
        $image = $oldImage;
    } else {
        $image = upload();
    }

    $query = "UPDATE sepeda_motor SET 
                model = '$model',
                image = '$image',
                merek = '$merek',
                harga = '$harga'
            WHERE id = $id
    ";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function delete($data) {
    global $conn;

    $id = htmlspecialchars($data['id']);
    $imageDir = htmlspecialchars($data['image']);
    unlink($imageDir);

    $query = "DELETE FROM sepeda_motor WHERE id=$id";
    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}


function idrCurrency($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

?>