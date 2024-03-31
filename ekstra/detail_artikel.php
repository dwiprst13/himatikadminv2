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

?>

<header class="bg-gray-900 w-[100%] sticky left-0 top-0">
    <nav class="h-16 w-[100%] flex mx-auto ">
        <div class="place-self-center p-5">
            <h1 class="text-white font-bold">Artikel</h1>
        </div>
    </nav>
</header>
<section class="w-[90%] flex mx-auto grid grid-cols-12">
    <div class="col-span-10 p-2">
        <h1 class="text-center pt-3 text-2xl"><b><?= $row_artikel['judul'] ?></b></h1>
        <img src="<?= $row_artikel['img'] ?>" alt="" class="h-60 pt-3 mx-auto object-cover">
        <p class="text-justify text-sm pt-3 line-clamp-3"><?= $row_artikel['content'] ?></p>
    </div>
    <div class="col-span-2 h-48 flex flex-col justify-between p-2 pt-5">
        <h2 class="text-center mt-8 font-bold">Tindakan</h2>
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
</section>