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
            <h1 class="h3 mb-0 text-gray-800">Daftar Peminjaman</h1>
            <div class="d-sm-flex align-items-center justify-content-between mb-1">
                <p class="">Berikut merupakan tabel yang berisi daftar peminjaman.</p>
                <a href="<?= base_url('peminjaman'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm ml-auto">
                    <i class="fas fa-upload fa-sm text-white-50"></i> Tambah Data</a>
                <a href="<?= base_url('daftarpeminjaman/export'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm ml-1">
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
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Peminjaman</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Peminjaman</th>
                                    <th>Peminjam</th>
                                    <th>Sarpras</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($peminjaman as $p) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $p['idpeminjaman']; ?></td>
                                        <td><?= $p['peminjam']; ?></td>
                                        <td><?= $p['sarpras']; ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['tglpinjam'])); ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['tglkembali'])); ?></td>
                                        <td><?= $p['status']; ?></td>
                                        <td>
                                            <a href="<?= base_url('daftarpeminjaman/ubah'); ?>/<?= $p['id']; ?>" class="btn btn-warning mb-1">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a class="btn btn-danger mb-1" href="#" data-toggle="modal" data-target="#hapusModal">
                                                <i class="fas fa-trash"></i>
                                            </a>

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
                                                            <form action="<?= base_url('daftarpeminjaman'); ?>/<?= $p['id']; ?>" method="post" class="d-inline">
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