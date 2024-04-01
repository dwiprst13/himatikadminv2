<?php
function countTableRows($conn, $table)
{
    $query = "SELECT COUNT(*) AS total_rows FROM $table";
    $result = mysqli_query($conn, $query);
    $totalRows = 0;

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $totalRows = $row['total_rows'];
    }
    return $totalRows;
}

$totalAdmin = countTableRows($conn, "admin");
$totalPengurus = countTableRows($conn, "pengurus");
$totalArtikel = countTableRows($conn, "artikel");
$totalGaleri = countTableRows($conn, "galeri");
$totalProker = countTableRows($conn, "Proker");
$totalPesan = countTableRows($conn, "Pesan");


?>
<!DOCTYPE html>
<html lang="en">

<div class="h-screen">
    <div class="grid grid-cols-12 gap-5 w-[90%] flex mx-auto py-8 text-white">
        <a href="/himatikadmin/admin" class="col-span-3 ">
            <div class="h-32 bg-blue-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Admin</h2>
                <p class="text-center text-[2.8rem]"><?= $totalAdmin; ?></p>
            </div>
        </a>
        <a href="/himatikadmin/pengurus" class=" col-span-3 ">
            <div class=" h-32 bg-orange-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Pengurus</h2>
                <p class="text-center text-[2.8rem]"><?= $totalPengurus; ?></p>
            </div>
        </a>
        <a href="" class="col-span-3 ">
            <div class="h-32 bg-yellow-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Galeri</h2>
                <p class="text-center text-[2.8rem]"><?= $totalGaleri; ?></p>
            </div>
        </a>
        <a href="" class="col-span-3 ">
            <div class="h-32 bg-green-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Artikel</h2>
                <p class="text-center text-[2.8rem]"><?= $totalArtikel; ?></p>
            </div>
        </a>
    </div>
    <div class="grid grid-cols-12 gap-5 w-[90%] flex mx-auto py-8 text-white">
        <a href="" class="col-span-3 ">
            <div class="h-32 bg-gray-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Proker</h2>
                <p class="text-center text-[2.8rem]"><?= $totalProker; ?></p>
            </div>
        </a>
        <a href="" class="col-span-3 ">
            <div class="h-32 bg-purple-500 w-full rounded-lg p-3">
                <h2 class="text-center text-[1.5rem] w-full bg-white text-black rounded-md">Pesan</h2>
                <p class="text-center text-[2.8rem]"><?= $totalPesan; ?></p>
            </div>
        </a>
    </div>
</div>

</html>