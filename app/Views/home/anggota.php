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
<li class="nav-item active">
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
            <h1 class="h3 mb-0 text-gray-800">Anggota</h1>
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <p class="">Berikut merupakan tabel daftar anggota.</p>
                <a href="<?= base_url('anggota/tambah'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                    <i class="fas fa-upload fa-sm text-white-50"></i> Tambah Data</a>
            </div>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <!-- Tabel -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Anggota</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>No Handphone</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($anggota as $a) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $a['nis']; ?></td>
                                        <td><?= $a['nama']; ?></td>
                                        <td><?= $a['kelas']; ?></td>
                                        <td><?= $a['nohp']; ?></td>
                                        <td>
                                            <a href="<?= base_url('anggota/ubah'); ?>/<?= $a['id']; ?>" class="btn btn-warning mb-1">Ubah</a>
                                            <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#hapusModal">Hapus</a>

                                            <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModal" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="hapusModal">Apakah yakin ingin dihapus?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">x</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Pilih "Hapus" untuk menghapus data.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                            <form action="<?= base_url('anggota'); ?>/<?= $a['id']; ?>" method="post" class="d-inline">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <button type="submit" class="btn btn-primary">Hapus</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?= $this->endSection(); ?>