<?php
$artikel = "SELECT * FROM artikel ORDER BY id_artikel";
$queryArtikel = mysqli_query($conn, $artikel);

if (isset($_GET['page']) && $_GET['page'] == 'edit_artikel') {
    include 'page/tambah_artikel.php';
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body class="bg-gray-200 min-h-screen">
        <div class="p-4 flex">
            <h1 class="text-xl">
                Daftar Artikel
            </h1>
        </div>
        <div class=" px-3 py-4 flex justify-between">
            <div>
                <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                    <a href="?page=tambah_artikel">Tambah</a>
                </button>
            </div>
            <div class="">
                <div class="flex mb-3 flex w-full flex-wrap ">
                    <input type="search" class="mx-auto m-0 -mr-0.5 block min-w-0 flex-auto rounded-l border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-[0.25rem] text-base font-normal leading-[1.6]  outline-none transition duration-200 ease-in-out focus:z-[3] focus:border-primary focus:text-blackfocus:shadow-[inset_0_0_0_1px_rgb(59,113,202)] focus:outline-none dark:border-gray-600 dark:focus:border-primary" placeholder="Search" aria-label="Search" aria-describedby="button-addon1" />

                    <!--Search button-->
                    <button class=" flex items-center rounded-r bg-blue-500 px-6 py-2.5 text-xs font-medium uppercase leading-tight text-white shadow-md transition duration-150 ease-in-out hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-primary-800 active:shadow-lg" type="button" id="button-addon1" data-te-ripple-init data-te-ripple-color="light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <section>
            <div class="container w-[90%] gap-5 flex mx-auto justify-end columns-3 px-4 py-8">
                <div>
                    <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">List</button>
                    <button class="mr-3 text-sm bg-blue-300 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Card</button>
                </div>
            </div>
        </section>
        <section class="w-[100%] mx-auto ">
            <div class="container w-[90%] gap-5 columns-3 mx-auto grid px-4">
                <?php
                if (mysqli_num_rows($queryArtikel) > 0) {
                ?>
                    <table class="w-full text-md table-auto bg-white shadow-md rounded mb-4">
                        <tbody>
                            <tr>
                                <th>Id</th>
                                <th>Judul</th>
                                <th>Gambar</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Edited</th>
                                <th>Tag</th>
                                <th>Edit</th>
                            </tr>
                            <?php
                            while ($row_artikel = mysqli_fetch_assoc($queryArtikel)) {
                                $status = $row_artikel['status'];
                                $judul = $row_artikel['judul'];
                                if (strlen($judul) > 12) {
                                    $judul = substr($judul, 0, 12) . '...';
                                }
                                $card_class = ($status === 'publish') ? 'bg-white' : 'bg-orange-200';
                            ?>
                                <tr class="px-3 border-b bg-gray-100">
                                    <td class="text-center"><?= $row_artikel['id_artikel']; ?></td>
                                    <td class="text-center"><?= $judul; ?></td>
                                    <td class="text-center"><img src="<?= $row_artikel['img']; ?>" alt="" class="h-10"></td>
                                    <td class="text-center"><?= $row_artikel['author']; ?></td>
                                    <td class="text-center"><?= $row_artikel['date']; ?></td>
                                    <td class="text-center"><?= $row_artikel['status']; ?></td>
                                    <td class="text-center"><?= $row_artikel['edited']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        $tagArray = explode(' ', $row_artikel['tag']);
                                        foreach ($tagArray as $tag) {
                                            echo $tag . "<br>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="?page=detail_artikel&id_artikel=<?= $row_artikel['id_artikel'] ?>">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="text-center w-full col-span-12">
                                <p class="text-[3.5rem]">Daftar artikel kosong.</p>
                            </div>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>


            </div>
        </section>
    </body>

    </html>
<?php
}
?>