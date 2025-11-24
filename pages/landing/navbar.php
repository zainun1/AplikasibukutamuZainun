<?php
$hal = isset($_GET['hal']) ? $_GET['hal'] : 'home';
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>assets/img/logo_rpl.png"
                 alt="Logo Aplikasi"
                 style="width:35px; height:35px; margin-right:8px;">
            <strong>aplikasi buku tamu</strong>
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarMain">

            <!-- LEFT -->
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link <?= ($hal=='home')?'active':'' ?>" 
                       href="<?= BASE_URL ?>?hal=home">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($hal=='kategori')?'active':'' ?>" 
                       href="<?= BASE_URL ?>?hal=kategori">daftar tamu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($hal=='tentang')?'active':'' ?>" 
                       href="<?= BASE_URL ?>?hal=tentang">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($hal=='kontak')?'active':'' ?>" 
                       href="<?= BASE_URL ?>?hal=kontak">Kontak</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($hal=='hashbycrypt')?'active':'' ?>" 
                       href="<?= BASE_URL ?>?hal=hashbycrypt">Hash BCRYPT</a>
                </li>

            </ul>

            <!-- RIGHT -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm mr-2 <?= ($hal=='loginpeminjam')?'active':'' ?>"
                       href="<?= BASE_URL ?>?hal=loginpeminjam">
                       <i class="fas fa-user"></i> Login tamu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-warning btn-sm <?= ($hal=='loginuser')?'active':'' ?>"
                       href="<?= BASE_URL ?>?hal=loginuser">
                       <i class="fas fa-user-shield"></i> Login User
                    </a>
                </li>

            </ul>

        </div>
    </div>
</nav>
