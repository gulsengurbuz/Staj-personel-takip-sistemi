<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Takip Sistemi</title>

    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            background-color: #ffffff;
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .wrapper {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 310px;
            height: 100vh;
            background: #f8f9fa;
            padding-top: 60px;
            position: fixed;
            transition: width 0.3s ease-in-out;
            box-shadow: 4px 0 10px rgba(5, 0, 148, 0.2);
            overflow-y: auto;
        }

        .sidebar.hidden {
            width: 80px;
            padding: 0;
        }

        .sidebar a {
            color: #003366;
            text-decoration: none;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover {
            background-color: #003366;
            color: #ffffff;
            border-left: 4px solid #ffffff;
        }

        .sidebar .item-text {
            margin-left: 12px;
            display: inline-block;
            transition: 0.3s;
        }

        .sidebar.hidden .item-text {
            display: none;
        }

        .content {
            margin-left: 310px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s ease-in-out;
        }

        .content.full {
            margin-left: 0;
        }

        footer {
            background: #3855aa;
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 14px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .toggle-btn {
            cursor: pointer;
            background: none;
            border: none;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .toggle-btn:hover {
            background: lightgray;
        }

        .bg-info1 {
            background: #3855aa;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .sidebar.hidden {
                width: 250px;
            }

            .content {
                margin-left: 0;
            }

            .content.full {
                margin-left: 250px;
            }
        }

        /* Karanlık Mod */
        .dark-mode {
            background-color: #212529;
            color: white;
        }

        .bg-body-tertiary {
            background-color: #f8f9fa !important;
        }

    </style>

</head>
<body>

<?php 
   include "../../public/php/navbar.php";
   $base_url = "https://orakoglu.net/gulsen/Personel_Takip_Sistemi/app/views/";
?>

<nav class="sidebar" id="sidebar">
    <a href="<?= $base_url ?>anasayfa.php" class="sidebar-item" >
        <i class="fas fa-home"></i>
        <span class="item-text">Anasayfa</span>
    </a>
    <a href="<?= $base_url ?>personelEkle.php" class="sidebar-item">
        <i class="fas fa-users"></i>
        <span class="item-text">Personel Listesi</span>
    </a>
    <a href="<?= $base_url ?>izinyonetimipage.php" class="sidebar-item">
        <i class="fas fa-calendar-check"></i>
        <span class="item-text">İzin Yönetimi</span>
    </a>
    <a href="<?= $base_url ?>maas_odeme.php" class="sidebar-item">
        <i class="fas fa-money-bill-wave"></i>
        <span class="item-text">Maaş ve Ödemeler</span>
    </a>
    <a href="<?= $base_url ?>yoneticionay.php" class="sidebar-item">
        <i class="fas fa-user-shield"></i>
        <span class="item-text">Yönetici Onay</span>
    </a>
    <a href="<?= $base_url ?>ayarlar.php" class="sidebar-item">
        <i class="fas fa-cog"></i>
        <span class="item-text">Ayarlar</span>
    </a>
    <a href="<?= $base_url ?>destekiletisim.php" class="sidebar-item">
        <i class="fas fa-envelope"></i>
        <span class="item-text">Destek ve İletişim</span>
    </a>
    <a href="<?= $base_url ?>login.php" class="sidebar-item">
        <i class="fas fa-sign-out-alt"></i>
        <span class="item-text">Çıkış</span>
    </a>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>
