<?php
function updateStatus($conn, $id_artikel, $status)
{
    $query = "UPDATE artikel SET status='$status' WHERE id_artikel='$id_artikel'";
    $update_status = mysqli_query($conn, $query);
    if ($update_status) {
    } else {
        $alert = "<div class='alert alert-danger'>Error updating status</div>";
    }
}

function deleteArtikel($conn, $id_artikel)
{
    $query = "DELETE FROM artikel WHERE id_artikel='$id_artikel'";
    $delete_artikel = mysqli_query($conn, $query);
    if ($delete_artikel) {
        echo '<script>window.location.href = "?page=artikel";</script>';
    } else {
        echo "<div class='alert alert-danger'>Error deleting artikel</div>";
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'detail_artikel') {
}
if (isset($_POST["hapus"])) {
    $id_artikel = $_GET['id_artikel'];
    deleteArtikel($conn, $id_artikel);
}
if (isset($_POST["hapus"])) {
    $id_artikel = $_GET['id_artikel'];
    deleteArtikel($conn, $id_artikel);
}
if (isset($_POST["arsip"])) {
    $id_artikel = $_POST['id_artikel'];
    updateStatus($conn, $id_artikel, 'unpublish');
}
if (isset($_POST["unarsip"])) {
    $id_artikel = $_POST['id_artikel'];
    updateStatus($conn, $id_artikel, 'publish');
}

$id_artikel = $_GET['id_artikel'];
$result = mysqli_query($conn, "SELECT * FROM artikel WHERE id_artikel='$id_artikel'");
$row_artikel = mysqli_fetch_assoc($result);
$status = $row_artikel['status'];
$author = $row_artikel['author'];
$date = $row_artikel['date'];
$tag = $row_artikel['tag'];
$edited = $row_artikel['edited'];
$edited_by = $row_artikel['edited_by'];

$konten = $row_artikel['content'];
$konten = str_replace('<h2>', '<h2 style="font-size: 2rem; font-weight: bold;">', $konten);
$konten = str_replace('<h3>', '<h3 style="font-size: 1.4rem; font-weight: bold;">', $konten);
$konten = str_replace('<em>', '<em style=" font-style: italic;">', $konten);
$konten = str_replace('<code>', '<code class="italic bg-gray-200">', $konten);
$konten = str_replace('<pre>', '<pre class="italic bg-gray-200">', $konten);
$konten = str_replace('<p>', '<p style="font-size: 1rem;">', $konten);
?>
<section class="">
    <div class="w-[90%] flex mx-auto grid grid-cols-12">
        <div class="col-span-10 p-2 pt-5 pb-10 bg-white rounded-lg my-3">
            <div class="px-3 py-3">
                <h1 class="text-center pt-3 text-[2.5rem]"><b><?= $row_artikel['judul'] ?></b></h1>
                <img src="<?= $row_artikel['img'] ?>" alt="" class="h-60 my-5 mx-auto object-cover">
                <p class="text-justify text-sm pt-3"><?= $konten ?></p>
            </div>
        </div>
        <div class="col-span-2">
            <div class="h-64 flex flex-col justify-between p-2 pt-5">
                <h2 class="text-center mt-8 font-bold">Tindakan</h2>
                <form action="?page=artikel">
                    <button type="submit" class="mr-3 w-[100%] text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Kembali</button>
                </form>
                <form action="" method="get">
                    <input type="hidden" name="page" value="edit_artikel">
                    <input type="hidden" name="id_artikel" value="<?= $row_artikel['id_artikel'] ?>">
                    <button type="submit" class="mr-3 w-[100%] text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Edit</button>
                </form>
                <?php
                if ($status === 'publish') {
                ?>
                    <form action="" method="post">
                        <input type="hidden" name="id_artikel" value="<?= $row_artikel['id_artikel'] ?>">
                        <button type="submit" name="arsip" class="mr-3 w-[100%] text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Arsipkan</button>
                    </form>
                <?php
                } else {
                ?>
                    <form action="" method="post">
                        <input type="hidden" name="id_artikel" value="<?= $row_artikel['id_artikel'] ?>">
                        <button type="submit" name="unarsip" class="mr-3 w-[100%] text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Batal Arsip</button>
                    </form>
                <?php
                }
                ?>
                <form action="" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus data ini?');">
                    <input type="hidden" name="id_artikel" value="<?= $row_artikel['id_artikel'] ?>">
                    <button type="submit" name="hapus" class="mr-3 w-[100%] text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Hapus</button>
                </form>
            </div>
            <div class="w-[90%] mx-auto justify-between space-y-2 text-[0.8rem] bg-white rounded-lg">
                <p class=" rounded-lg py-1 px-3">Author: <?= $author; ?></p>
                <p class=" rounded-lg py-1 px-3">Status:
                    <?php
                    if ($status === 'publish') {
                    ?>
                        <span class="text-green-500 rounded-lg py-1 px-3">Published</span>
                    <?php
                    } else {
                    ?>
                        <span class="text-red-500 rounded-lg py-1 px-3">Unpublished</span>
                    <?php
                    }
                    ?>
                </p>
                <p class=" rounded-lg py-1 px-3">Tag: <?= $tag; ?></p>
                <p class=" rounded-lg py-1 px-3">Tanggal: <?= $date; ?></p>
                <p class=" rounded-lg py-1 px-3">Diedit: <?= $edited; ?></p>
                <p class=" rounded-lg py-1 px-3">Diedit Oleh: <?= $edited_by; ?></p>
            </div>
        </div>
    </div>
</section>