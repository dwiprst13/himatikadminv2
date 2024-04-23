<?php

$id_artikel = $_GET['id_artikel'];
$result = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel='$id_artikel'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $new_judul = $_POST["new_judul"];
    $new_isi = $_POST["new_isi"];
    $new_tag = $_POST["new_tag"];
    $new_status = $_POST["new_status"];
    $edited = date("Y-m-d H:i:s");
    $edited_by = "Editor";

    if ($_FILES['new_foto']['size'] > 0) {
        $uploadDir = "public/uploads/artikel/";
        $new_foto = $uploadDir . basename($_FILES['new_foto']['name']);
        if (!move_uploaded_file($_FILES['new_foto']['tmp_name'], $new_foto)) {
            $new_foto = $row['img'];
        }
    } else {
        $new_foto = $row['img'];
    }

    $update_artikel = $conn->prepare("UPDATE artikel SET img=?, judul=?, content=?, tag=?, status=?, edited=?, edited_by=? WHERE id_artikel=?");
    $update_artikel->bind_param("ssssssss", $new_foto, $new_judul, $new_isi, $new_tag, $new_status, $edited, $edited_by, $id_artikel);

    if ($update_artikel->execute()) {
        echo '<script>window.location.href = "?page=artikel";</script>';
        exit();
    } else {
        echo "Error updating artikel: " . $conn->error;
    }

    $update_artikel->close();
}
?>


<body class="flex">

    <body class=" w-[80%] h-screen">
        <div class="flex text-sm md:text-base h-24 w-[90%] mx-auto text-lg ">
            <div class="place-self-center">
                <p>Tambah Artikel</p>
            </div>
        </div>
        <form class="w-[90%] flex flex-col mx-auto pb-32" action="" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="">
                <div class="space-y-6">
                    <div class="mx-auto w-[100%]">
                        <label for="new_judul" class="block text-sm font-medium leading-6 ">Judul</label>
                        <div class="mt-2">
                            <input id="new_judul" name="new_judul" type="text" autocomplete="off" placeholder="Judul" required value="<?= $row['judul'] ?>" class="block w-[100%]  rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="mx-auto w-[100%]">
                        <label for="new_foto" class="block text-sm font-medium leading-6">Gambar</label>
                        <div class="grid grid-cols-12 gap-10">
                            <div class="col-span-4 h-full flex items-center">
                                <input id="new_foto" name="new_foto" type="file" autocomplete="" multiple onchange="readURL(this)" accept="image/*" class="bg-white block w-[100%] p-5 file:mr-4 file:py-1 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-100 file:cursor-pointer rounded-md border-0 py-1.5 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                            <div class="flex col-span-8 place-items-center mxbg-blue-800 relative bg-gray-500 rounded-lg">
                                <img src="<?= $row['img'] ?>" id="img" class="h-96 object-cover align-items-center mx-auto">
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto w-[100%]  ">
                        <label for="new_isi" class="block text-sm font-medium leading-6 ">Isi</label>
                        <div class="mt-2">
                            <textarea id="new_isi" name="new_isi" rows="16" cols="50" type="text" autocomplete="off" class="block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"><?= $row['content'] ?></textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-8 gap-10">
                        <div class="col-span-4">
                            <label for="new_tag" class="block text-sm font-medium leading-6 ">Tag</label>
                            <input type="text" placeholder="Maksimal 2 tag, pisahkan dengan '#' (#tag1 #tag2)" id="new_tag" name="new_tag" value="<?= $row['tag'] ?>" class="mt-2 block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="col-span-4">
                            <label for="new_status" class="block text-sm font-medium leading-6 ">Status</label>
                            <select type="text" id="new_status" name="new_status" class="mt-2 block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="publish">Published</option>
                                <option value="unpublish">UnPublished</option>
                            </select>
                        </div>
                    </div>
                    <div class="mx-auto w-[100%] ">
                        <button type="submit" name="submit" class="flex w-[100%] justify-center rounded-md bg-blue-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Kirim</button>
                    </div>
                </div>
            </div>

        </form>
        <script>
            function readURL(input) {
                var img = document.querySelector("#img");
                var gambarText = document.querySelector("#gambarText");
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        img.setAttribute("src", e.target.result);
                        gambarText.style.display = "none";
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    gambarText.style.display = "block";
                }
            }

            tinymce.init({
                selector: 'textarea',
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            });
        </script>