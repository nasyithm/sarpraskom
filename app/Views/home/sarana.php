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
            <h1 class="h3 mb-0 text-gray-800">Sarana</h1>
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <p class="">Berikut merupakan tabel daftar sarana yang tersedia.</p>
                <a href="<?= base_url('sarana/tambah'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ml-auto">
                    <i class="fas fa-upload fa-sm text-white-50"></i> Tambah Data</a>
                <a href="<?= base_url('sarana/export'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm ml-1">
                    <i class="fas fa-file-export fa-sm text-white-50"></i> Export Excel</a>
            </div>

            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>
            <?php endif; ?>

            <!-- Tabel -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Sarana</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Spesifikasi</th>
                                    <th>Jumlah (Tersedia)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($sarana as $s) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $s['kode']; ?></td>
                                        <td><?= $s['nama']; ?></td>
                                        <td><?= $s['spesifikasi']; ?></td>
                                        <td><?= ($s['jumlah'] > 0) ? $s['jumlah'] : 'Tidak Tersedia'; ?></td>
                                        <td>
                                            <a href="<?= base_url('sarana/ubah'); ?>/<?= $s['id']; ?>" class="btn btn-warning mb-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <form action="<?= base_url('sarana'); ?>/<?= $s['id']; ?>" method="post" class="d-inline">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger mb-1" onclick="return confirm('Apakah yakin ingin dihapus?');">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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