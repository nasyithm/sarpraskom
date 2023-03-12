<?= $this->extend('/layout/dashboard'); ?>

<?= $this->section('dashboard-content'); ?>

<?= $this->include('/layout/navbar'); ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('/layout/topbar'); ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-0 text-gray-800">Profil</h1>
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <p class="">Berikut merupakan data profil akun Anda.</p>
            </div>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <!-- Profil -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Akun</h6>
                </div>
                <div class="card-body text-dark">
                    <p>User ID &nbsp; : &nbsp; <?= $userid; ?></p>
                    <p>Nama &emsp; : &nbsp; <?= $nama; ?></p>
                </div>
            </div>

            <!-- Option Profil -->
            <a href="<?= base_url('profil/ubah'); ?>/<?= $id; ?>" class="btn btn-warning mb-1">
                <i class="fas fa-pen"></i>
            </a>
            <form action="<?= base_url('profil'); ?>/<?= $id; ?>" method="post" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Apakah yakin ingin dihapus?');">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?= $this->endSection(); ?>