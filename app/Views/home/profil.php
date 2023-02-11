<?= $this->extend('/layout/dashboard'); ?>

<?= $this->section('dashboard-content'); ?>
<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Informasi
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('sarana'); ?>">
        <i class="fas fa-fw fa-toolbox"></i>
        <span>Sarana</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('prasarana'); ?>">
        <i class="fas fa-fw fa-school"></i>
        <span>Prasarana</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Peminjaman
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('peminjaman'); ?>">
        <i class="fas fa-fw fa-shopping-basket"></i>
        <span>Peminjaman</span></a>
</li>

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('daftarpeminjaman'); ?>">
        <i class="fas fa-fw fa-list"></i>
        <span>Daftar Peminjaman</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Anggota
</div>

<!-- Nav Item - Charts -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('anggota'); ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>Anggota</span></a>
</li>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
        <?= $this->include('/layout/dashtopbar'); ?>

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
                <div class="card-body">
                    <p>User ID &nbsp; : &nbsp; <?= $userid; ?></p>
                    <p>Nama &emsp; : &nbsp; <?= $nama; ?></p>
                </div>
            </div>

            <!-- Option Profil -->
            <a href="<?= base_url('profil/ubah'); ?>/<?= $id; ?>" class="btn btn-warning">
                <i class="fas fa-pen"></i>
            </a>
            <a class="btn btn-danger mb-1" href="#" data-toggle="modal" data-target="#hapusModal">
                <i class="fas fa-trash"></i>
            </a>

            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapusModal">Apakah Anda yakin untuk menghapus akun?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">Pilih "Hapus" untuk menghapus akun dan akan otomatis keluar dari halaman.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <form action="<?= base_url('profil'); ?>/<?= $id; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-primary">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?= $this->endSection(); ?>