<?php

if (isset($_POST["submit"])) {
    $judul = $_POST["judul"];
    $isi = $_POST["isi"];
    $tag = $_POST["tag"];
    // $author = $_POST["author"];
    $status = $_POST["status"];
    $target_dir = "public/uploads/artikel/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file);
    $sql = "INSERT INTO artikel (judul, img, content, tag, status, date) VALUES ('$judul', '$target_file', '$isi', '$tag', '$status', CURRENT_TIMESTAMP)";

    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";
    }
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
                        <label for="judul" class="block text-sm   font-medium leading-6 ">Judul</label>
                        <div class="mt-2">
                            <input id="judul" name="judul" type="text" autocomplete="off" placeholder="Judul" required class="block w-[100%]  rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="mx-auto w-[100%]">
                        <div class="">
                            <label for="foto" class="block text-sm font-medium leading-6">Gambar</label>
                            <div class="grid grid-cols-12 gap-10">
                                <div class="col-span-4 h-full flex items-center">
                                    <input id="foto" name="foto" type="file" autocomplete="" multiple onchange="readURL(this)" required accept="image/*" class="bg-white block w-[100%] p-5 file:mr-4 file:py-1 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-100 file:cursor-pointer rounded-md border-0 py-1.5 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                                <div class="flex col-span-8 place-items-center mxbg-blue-800 relative bg-gray-500 rounded-lg">
                                    <span id="gambarText" class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-center">Pilih Gambar Header Artikel</span>
                                    <img src="" id="img" class="h-96 object-cover align-items-center mx-auto" onload="readURL()">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mx-auto w-[100%]  ">
                        <label for="isi" class="block text-sm font-medium leading-6 ">Isi</label>
                        <div class="mt-2">
                            <textarea id="isi" name="isi" rows="16" cols="50" type="text" placeholder="Isi Artikel" autocomplete="off" class="block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-8 gap-10">
                        <div class="col-span-4">
                            <label for="tag" class="block text-sm font-medium leading-6 ">Tag</label>
                            <input type="text" placeholder="Maksimal 2 tag, pisahkan dengan '#' (#tag1 #tag2)" id="tag" name="tag" class="mt-2 block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                        <div class="col-span-4">
                            <label for="status" class="block text-sm font-medium leading-6 ">Status</label>
                            <select type="text" id="status" name="status" class="mt-2 block w-[100%] rounded-md border-0 py-1.5 text-gray-900 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
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
                        gambarText.style.display = "block";
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