<?php
include 'config.php';

$id_admin_login = @$_SESSION['id_admin_admin'];
$q_data_admin_login = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin='$id_admin_login'");
$data_admin_login = mysqli_fetch_array($q_data_admin_login);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/styles/tailwind.css">
    <link rel="stylesheet" href="https://demos.creative-tim.com/notus-js/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="../assets/js/script.js" defer></script>
    <title>Himatik Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/92xg6wlqw9faoyfala0uu4ysc1irr953fn9goktkphy4w1ir/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body>
    <div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
        <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
            <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
            <span class="text-lg font-bold text-white ml-3">HimatikAdmin</span>
        </a>
        <ul class="mt-4">
            <li class="mb-1 group">
                <?php
                $currentPath = rtrim($_SERVER['REQUEST_URI'], '/');
                $isActive = $currentPath == '/himatikadmin' || $currentPath == '/himatikadmin/dashboard';
                ?>
                <a href="/himatikadmin/dashboard" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo $isActive ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>
            <li class="mb-1 group ">
                <a href="/himatikadmin/admin" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'admin' || $page == 'edit_admin' || $page == 'tambah_admin') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Admin</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="/himatikadmin/pengurus" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'pengurus' || $page == 'edit_pengurus' || $page == 'tambah_pengurus') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-settings-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Pengurus</span>
                </a>
            </li>
            <li class="mb-1 group ">
                <a href="/himatikadmin/divisi" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'divisi' || $page == 'edit_divisi' || $page == 'tambah_divisi') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Divisi</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="/himatikadmin/proker" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'proker' || $page == 'edit_proker' || $page == 'tambah_proker') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-settings-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Proker</span>
                </a>
            </li>
            <li class="mb-1 group ">
                <a href="/himatikadmin/artikel" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'artikel' || $page == 'edit_artikel' || $page == 'detail_artikel'|| $page == 'tambah_artikel') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Artikel</span>
                </a>
            </li>
            <li class="mb-1 group ">
                <a href="/himatikadmin/galeri" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'galeri' || $page == 'edit_galeri' || $page == 'tambah_galeri') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Galeri</span>
                </a>
            </li>
            <li class="mb-1 group ">
                <a href="/himatikadmin/info" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'info' || $page == 'edit_info' || $page == 'tambah_info') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Info</span>
                </a>
            </li>
            <li class="mb-1 group">
                <a href="/himatikadmin/pesan" class="flex items-center py-2 px-4 text-gray-300 rounded-md <?php echo ($page == 'pesan' || $page == 'edit_pesan' || $page == 'tambah_pesan') ? 'bg-blue-500 hover:bg-blue-500' : 'hover:bg-gray-950 hover:text-gray-100 '; ?>">
                    <i class="ri-settings-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Pesan</span>
                </a>
            </li>
        </ul>
    </div>
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="h-16 flex bg-gray-900 text-white grid items-center">
            <div class="flex w-[80%] mx-auto justify-between">
                <div class="flex gap-5 items-center">
                    <h2 class="font-bold ">Dwi Prasetia</h2>
                    <p>223200230</p>
                </div>
                <div>
                    <button class="bg-red-500 rounded-md p-1 px-2">Logout</button>
                </div>
            </div>
        </div>
        <div class="bg-gray-200 min-h-screen items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

            switch ($page) {
                case 'artikel':
                    include 'page/artikel.php';
                    break;
                case 'tambah_artikel':
                    include 'page/tambah/tambah_artikel.php';
                    break;
                case 'edit_artikel':
                    include 'page/edit/edit_artikel.php';
                    break;
                case 'detail_artikel':
                    include 'page/detail/detail_artikel.php';
                    break;
                    // ===================> Include page admin <===================
                case 'admin':
                    include 'page/admin.php';
                    break;
                case 'tambah_admin':
                    include 'page/tambah/tambah_admin.php';
                    break;
                case 'edit_admin':
                    include 'page/edit/edit_admin.php';
                    break;
                case 'search_admin':
                    include 'ekstra/search_admin.php';
                    break;
                    // ===================> Include page galeri <===================
                case 'galeri':
                    include 'page/galeri.php';
                    break;
                case 'edit_galeri':
                    include 'page/edit/edit_galeri.php';
                    break;
                case 'tambah_galeri':
                    include 'page/tambah/tambah_galeri.php';
                    break;
                default:
                    include 'page/dashboard.php';
                    break;
                    // ===================> Include page divisi <===================
                case 'divisi':
                    include 'page/divisi.php';
                    break;
                case 'edit_divisi':
                    include 'page/edit/edit_divisi.php';
                    break;
                case 'tambah_divisi':
                    include 'page/tambah/tambah_divisi.php';
                    break;
                    // ===================> Include page info <===================
                case 'info':
                    include 'page/info.php';
                    break;
                case 'edit_info':
                    include 'page/edit/edit_info.php';
                    break;
                case 'tambah_info':
                    include 'page/tambah/tambah_info.php';
                    break;
                    // ===================> Include page pengurus <===================
                case 'pengurus':
                    include 'page/pengurus.php';
                    break;
                case 'edit_pengurus':
                    include 'page/edit/edit_pengurus.php';
                    break;
                case 'tambah_pengurus':
                    include 'page/tambah/tambah_pengurus.php';
                    break;
                    // ===================> Include page pesan <===================
                case 'pesan':
                    include 'page/pesan.php';
                    break;
                case 'edit_pesan':
                    include 'page/edit/edit_pesan.php';
                    break;
                case 'tambah_pesan':
                    include 'page/tambah/tambah_pesan.php';
                    break;
                    // ===================> Include page proker <===================
                case 'proker':
                    include 'page/proker.php';
                    break;
                case 'edit_proker':
                    include 'page/edit/edit_proker.php';
                    break;
                case 'tambah_proker':
                    include 'page/tambah/tambah_proker.php';
                    break;
            }
            ?>
        </div>
    </main>

    </div>
    </div>
    <script>
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                window.location.href = '../../logout.php'; // Redirect ke halaman logout jika dikonfirmasi
            }
        }
    </script>
</body>