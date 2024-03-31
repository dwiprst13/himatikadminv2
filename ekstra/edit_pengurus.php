<?php

$id_pengurus = $_GET['id_pengurus'];
$result = mysqli_query($conn, "SELECT * FROM pengurus WHERE id_pengurus='$id_pengurus'");
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $new_name = $_POST['new_name'];
    $new_panggilan = $_POST['new_panggilan'];
    $new_nim = $_POST['new_nim'];
    $new_divisi = $_POST['new_divisi'];
    $new_posisi = $_POST['new_posisi'];
    $new_ig = $_POST['new_ig'];
    $new_linkedin = $_POST['new_linkedin'];
    $new_github = $_POST['new_github'];


    if ($_FILES['fotopengurus']['size'] > 0) {
        $uploadDir = "uploads/pengurus/";
        $new_foto = $uploadDir . basename($_FILES['fotopengurus']['name']);
        if (!move_uploaded_file($_FILES['fotopengurus']['tmp_name'], $new_foto)) {
            $new_foto = $row['foto'];
        }
    } else {
        $new_foto = $row['foto'];
    }


    $update_pengurus = $conn->prepare("UPDATE pengurus SET nama=?, nama_panggilan=?, nim=?, foto=?, divisi=?, posisi=?, ig_link=?, linkedin_link=?, github_link=? WHERE id_pengurus=?");
    $update_pengurus->bind_param("ssssssssss", $new_name, $new_panggilan, $new_nim, $new_foto, $new_divisi, $new_posisi, $new_ig, $new_linkedin, $new_github, $id_pengurus);

    if ($update_pengurus->execute()) {
        echo '<script>window.location.href = "?page=pengurus";</script>';
        exit();
    } else {
        echo "Error updating pengurus: " . $conn->error;
    }

    $update_pengurus->close();
}
?>


<div class="min-h-screen">
    <div class="p-4 flex">
        <h1 class="text-xl">
            Edit pengurus
        </h1>
    </div>
    <div class=" px-3 py-4 flex justify-between">
        <div>
            <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                <a href="?page=pengurus">Kembali</a>
            </button>
        </div>
    </div>
    <form method="post" class="pb-10" enctype="multipart/form-data">
        <input type="hidden" name="id_pengurus" value="<?= $row['id_pengurus'] ?>">
        <div class=" grid grid-cols-8 ">
            <div class="space-y-6 col-span-4 p-5">
                <div>
                    <label for="new_name" class="block text-sm font-medium leading-6">Nama:</label>
                    <input type="text" name="new_name" value="<?= $row['nama'] ?>" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="new_panggilan" class="block text-sm font-medium leading-6">Alias:</label>
                    <input type="text" name="new_panggilan" value="<?= $row['nama_panggilan'] ?>" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="new_nim" class="block text-sm font-medium leading-6">NIM:</label>
                    <input type="text" name="new_nim" value="<?= $row['nim'] ?>" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="fotopengurus" class="block text-sm font-medium leading-6">Foto</label>
                    <input id="fotopengurus" name="fotopengurus" type="file" autocomplete="" multiple onchange="readURL(this)" accept="image/*" placeholder="Pilih Foto" enctype="multipart/form-data" class="bg-white block w-[100%] p-5 file:mr-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-violet-500 file:cursor-pointer rounded-md border-0 py-1.5 white shadow-sm ring-1 ring-inset ring-gray-300 placeholder:  focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div class="flex mx-auto w-[100%] place-items-center mx-auto">
                    <img src="<?= $row['foto'] ?>" id="img" class="align-items-center h-32">
                </div>
            </div>
            <div class="space-y-6 col-span-4 p-5">
                <div>
                    <label for="new_divisi" class="block text-sm font-medium leading-6">Divisi</label>
                    <select id="new_divisi" name="new_divisi" required class="block w-full rounded-md p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="Ketua" <?php echo ($row['divisi'] == 'Ketua') ? 'selected' : ''; ?>>Ketua</option>
                        <option value="Wakil Ketua" <?php echo ($row['divisi'] == 'Wakil Ketua') ? 'selected' : ''; ?>>Wakil Ketua</option>
                        <option value="BPH" <?php echo ($row['divisi'] == 'BPH') ? 'selected' : ''; ?>>BPH</option>
                        <option value="Kominfo" <?php echo ($row['divisi'] == 'Kominfo') ? 'selected' : ''; ?>>Kominfo</option>
                        <option value="Sosmas" <?php echo ($row['divisi'] == 'Sosmas') ? 'selected' : ''; ?>>Sosmas</option>
                        <option value="Diklat" <?php echo ($row['divisi'] == 'Diklat') ? 'selected' : ''; ?>>Diklat</option>
                        <option value="PSDA" <?php echo ($row['divisi'] == 'PSDA') ? 'selected' : ''; ?>>PSDA</option>
                        <option value="Keagamaan" <?php echo ($row['divisi'] == 'Keagamaan') ? 'selected' : ''; ?>>Keagamaan</option>
                    </select>
                </div>

                <div>
                    <label for="new_posisi" class="block text-sm font-medium leading-6">Posisi</label>
                    <input type="text" name="new_posisi" value="<?= $row['posisi'] ?>" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="new_ig" class="block text-sm font-medium leading-6">Link Instagram</label>
                    <input type="text" name="new_ig" value="<?= $row['ig_link'] ?>" class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="new_linkedin" class="block text-sm font-medium leading-6">Link Linkedin</label>
                    <input type="text" name="new_linkedin" value="<?= $row['linkedin_link'] ?>" class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
                <div>
                    <label for="new_github" class="block text-sm font-medium leading-6">Link Github</label>
                    <input type="text" name="new_github" value="<?= $row['github_link'] ?>" class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
        </div>
        <div>
            <button type="submit" name="submit" class="flex text-white justify-center rounded-md w-[20%] bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mx-auto">
                Update
            </button>
        </div>
    </form>
</div>
<script>
    function readURL(input) {
        var img = document.querySelector("#img");
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.setAttribute("src", e.target.result);
                img.style.height = '150px'; // Atur tinggi foto
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            img.removeAttribute("src");
            img.style.height = 'auto';
        }
    }
</script>