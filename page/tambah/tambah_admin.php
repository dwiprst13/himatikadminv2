<?php
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $nim = $_POST["nim"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmpassword"];
    $role = $_POST["role"];

    $duplicate = mysqli_query($conn, "SELECT * FROM admin WHERE nim = '$nim' OR email = '$email'");
    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script> showPopup('Email Sudah Digunakan'); </script>";
    } else {
        if ($password == $confirmpassword) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO admin (nama, email, nim, password, role) VALUES ('$name','$email', '$nim', '$hashed_password', '$role')";
            mysqli_query($conn, $query);
            echo "<script> showPopup('Pendaftaran Sukses'); </script>";
        } else {
            echo "<script> showPopup('Pendaftaran Gagal'); </script>";
        }
    }
}
?>

<!DOCTYPE html>
<div class="flex flex-col min-h-screen">
    <div class="p-4 flex">
        <h1 class="text-xl">
            Tambah Admin
        </h1>
    </div>
    <div class=" px-3 py-4 flex justify-between">
        <div>
            <button class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                <a href="?page=admin">Kembali</a>
            </button>
        </div>
    </div>
    <div class="sm:mx-auto sm:w-full ">
        <form class="space-y-6" action="#" method="POST">
            <div class=" grid grid-cols-8 ">
                <div class="space-y-6 col-span-4 p-5">
                    <div class=" ">
                        <label for="name" class="block text-sm font-medium leading-6">Nama</label>
                        <div class="mt-2">
                            <input id="name" name="name" type="text" autocomplete="off" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class=" ">
                        <label for="email" class="block text-sm font-medium leading-6  ">Email</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="off" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="nik" class="block text-sm font-medium leading-6  ">NIM</label>
                        <div class="mt-2">
                            <input id="nim" name="nim" type="text" autocomplete="off" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                </div>
                <div class="space-y-6 col-span-4 p-5">
                    <div>
                        <label for="password" class="block text-sm font-medium leading-6  ">Kata Sandi</label>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="off" required class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="confirmpassword" class="block text-sm font-medium leading-6  ">Ulangi Kata Sandi</label>
                        <div class="mt-2">
                            <input id="confirmpassword" name="confirmpassword" type="password" autocomplete="off" required class="block w-full rounded-md p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium leading-6 ">Tipe User</label>
                        <div class="mt-2">
                            <select id="role" name="role" class="block w-full rounded-md  p-3 border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                <option value="SuperAdmin">SuperAdmin</option>
                                <option value="Admin">Admin</option>
                                <option value="Jurnalis">Jurnalis</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center pb-16 mx-auto">
                <button type="submit" action="" name="submit" class="flex text-white justify-center rounded-md w-[50%] bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
            </div>
        </form>
    </div>
</div>