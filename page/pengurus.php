<?php
if (isset($_POST["hapus"])) {
    $id_pengurus = $_POST['id_pengurus'];

    $delete_pengurus = mysqli_query($conn, "DELETE FROM pengurus WHERE id_pengurus='$id_pengurus'");
    if ($delete_pengurus) {
        echo "<meta http-equiv='refresh' content='0; url=?page=pengurus'>";
    } else {
        $alert = "<div class='alert alert-danger'>Error deleting pengurus</div>";
    }
}

?>
<?php
if (isset($_GET['page']) && $_GET['page'] == 'tambah_pengurus') {
    include 'ekstra/tambah_pengurus.php';
} else {
?>

    <body>
        <div class="text-gray-900 bg-gray-200 h-screen">
            <div class="p-4 flex">
                <h1 class="text-xl">
                    Daftar Pengurus
                </h1>
            </div>
            <div class=" px-3 py-4 flex justify-between">
                <div>
                    <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                        <a href="?page=tambah_pengurus">Tambah</a>
                    </button>
                </div>
                <div class="mb-3">
                    <form method="post" class="flex mb-4 flex w-full flex-wrap ">
                        <input type="search" class="mx-auto m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6]  outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-blackfocus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-gray-600 dark:focus:border-primary" placeholder="Search" aria-label="Search" aria-describedby="button-addon1" />
                        <button class=" flex items-center rounded-r bg-blue-500 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg" type="button" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            <div class="px-3 py-4 flex justify-center">
                <table class="w-full text-md table-auto bg-white shadow-md rounded mb-4">
                    <tbody>
                        <tr class="border-b">
                            <th class="text-center p-3 px-5">Id</th>
                            <th class="text-center p-3 px-5">Nama</th>
                            <th class="text-center p-3 px-5">NIM</th>
                            <th class="text-center p-3 px-5">Divisi</th>
                            <th class="text-center p-3 px-5">Posisi</th>
                            <th class="text-center p-3 px-5">Foto</th>
                            <th class="text-center p-3 px-5">IG</th>
                            <th class="text-center p-3 px-5">Linkedin</th>
                            <th class="text-center p-3 px-5">Github</th>
                            <th class="text-center p-3 px-5">Edit</th>
                            <th class="text-center p-3 px-5">Hapus</th>
                            <th></th>
                        </tr>
                        <?php
                        if (isset($_POST['search'])) {
                            $searchKeyword = $_POST['search'];
                            $query = mysqli_query($conn, "SELECT * FROM pengurus WHERE nama LIKE '%$searchKeyword%' OR email LIKE '%$searchKeyword%' OR nim LIKE '%$searchKeyword%' ");
                        } else {
                            $query = mysqli_query($conn, "SELECT * FROM pengurus");
                        }

                        while ($row = mysqli_fetch_assoc($query)) {
                            //     $nim = $row['nim'];
                            //     }
                        ?>
                            <tr class="px-3 border-b bg-gray-100">
                                <td class="p-3 text-center px-5"><?= $row['id_pengurus'] ?></td>
                                <td class="p-3 text-center px-5"><?= $row['nama'] ?></td>
                                <td class="p-3 text-center px-5"><?= $row['nim'] ?></td>
                                <td class="p-3 text-center px-5"><?= $row['divisi'] ?></td>
                                <td class="p-3 text-center px-5"><?= $row['posisi'] ?></td>
                                <td class="p-3 text-center px-5">
                                    <?= !empty($row['foto']) ? '<span class="text-green-500">✓</span>' : '<span class="text-red-500">x</span>' ?>
                                </td>
                                <td class="p-3 text-center px-5">
                                    <?= !empty($row['ig_link']) ? '<span class="text-green-500">✓</span>' : '<span class="text-red-500">x</span>' ?>
                                </td>
                                <td class="p-3 text-center px-5">
                                    <?= !empty($row['linkedin_link']) ? '<span class="text-green-500">✓</span>' : '<span class="text-red-500">x</span>' ?>
                                </td>
                                <td class="p-3 text-center px-5">
                                    <?= !empty($row['github_link']) ? '<span class="text-green-500">✓</span>' : '<span class="text-red-500">x</span>' ?>
                                </td>
                                <td class="p-3 text-center px-5">
                                    <form action="" method="get">
                                        <input type="hidden" name="page" value="edit_pengurus">
                                        <input type="hidden" name="id_pengurus" value="<?= $row['id_pengurus'] ?>">
                                        <button type="submit" class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</button>
                                    </form>
                                </td>
                                <td class="p-3 text-center px-5">
                                    <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                                        <input type="hidden" name="id_pengurus" value="<?= $row['id_pengurus'] ?>">
                                        <button type="submit" name="hapus" class="mr-3 text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php
} ?>