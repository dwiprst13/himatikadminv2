<?php

$id_galeri = $_GET['id_galeri'];
$result = mysqli_query($conn, "SELECT * FROM galeri WHERE id_galeri='$id_galeri'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $new_judul = $_POST["new_judul"];
    $new_deskripsi = $_POST["new_deskripsi"];

    if ($_FILES['new_foto']['size'] > 0) {
        $uploadDir = "uploads/galeri/";
        $new_foto = $uploadDir . basename($_FILES['new_foto']['name']);
        if (!move_uploaded_file($_FILES['new_foto']['tmp_name'], $new_foto)) {
            $new_foto = $row['img'];
        }
    } else {
        $new_foto = $row['img'];
    }

    $update_galeri = $conn->prepare("UPDATE galeri SET img=?, judul=?, deskripsi=? WHERE id_galeri=?");
    $update_galeri->bind_param("ssss", $new_foto, $new_judul, $new_deskripsi, $id_galeri);
    if ($update_galeri->execute()) {
        echo '<script>window.location.href = "?page=galeri";</script>';
        exit();
    } else {
        echo "Error updating galeri: " . $conn->error;
    }

    $update_galeri->close();
}
?>

<body class="flex">

    <body class=" w-[80%] h-screen">
        <div class="flex text-sm md:text-base h-24 w-[90%] mx-auto text-lg ">
            <div class="place-self-center">
                <p>Tambah Galeri</p>
            </div>
        </div>
        <form class="w-[90%] grid flex flex-col mx-auto pb-32" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="grid grid-cols-12 gap-5">
                <div class="col-span-5">
                    <div class="mx-auto w-[100%]">
                        <label for="new_judul" class="block text-sm   font-medium leading-6 ">Judul</label>
                        <div class="mt-2">
                            <input id="new_judul" name="new_judul" type="text" autocomplete="off" placeholder="Judul" required class="block w-[100%]  rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="<?= $row['judul']; ?>">
                        </div>
                    </div>
                    <div class="mx-auto w-[100%]  ">
                        <label for="new_deskripsi" class="block text-sm font-medium leading-6 ">Deskripsi</label>
                        <div class="mt-2">
                            <textarea id="new_deskripsi" name="new_deskripsi" rows="4" cols="50" type="text" placeholder="Deskripsi Gambar" autocomplete="off" required class="block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $row['deskripsi']; ?></textarea>
                        </div>
                    </div>
                    <div class="mx-auto w-[100%]">
                        <label for="new_foto" class="block text-sm font-medium leading-6 ">Gambar</label>
                        <div class="mt-2">
                            <input id="new_foto" name="new_foto" type="file" autocomplete="" multiple onchange="readURL(this)" required accept="image/*" class="bg-white block w-[100%] p-5 file:mr-4 file:py-1 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-500 file:cursor-pointer rounded-md border-0 py-1.5 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <div class="col-span-7">
                    <div class="w-[100%] place-items-center mx-auto bg-gray-300 h-72 rounded-lg">
                        <img src="<?= $row['img'] ?>" id="img" class="h-72 object-cover align-items-center mx-auto">
                    </div>
                </div>
            </div>
            <div class="mx-auto w-[50%] my-5">
                <button type="submit" name="submit" class="flex w-[100%] justify-center rounded-md bg-blue-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Kirim
                </button>
            </div>
        </form>
        <script>
            function readURL(input) {
                var img = document.querySelector("#img");
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        img.setAttribute("src", e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    gambarText.style.display = "block";
                }
            }
        </script>