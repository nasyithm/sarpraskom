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
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Peminjaman</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk mengubah data peminjaman.</p>

            <form action="<?= base_url('daftarpeminjaman/update'); ?>/<?= $peminjaman['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="idpeminjaman" class="col-sm-2 col-form-label text-dark">ID Peminjaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark <?= (validation_show_error('idpeminjaman')) ? 'is-invalid' : ''; ?>" id="idpeminjaman" name="idpeminjaman" value="<?= old('idpeminjaman', $peminjaman['idpeminjaman']); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('idpeminjaman'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="peminjam" class="col-sm-2 col-form-label text-dark">Peminjam</label>
                    <div class="col-sm-10">
                        <select class="form-control text-dark" id="peminjam" name="peminjam" value="<?= old('peminjam', $peminjaman['peminjam']); ?>">
                            <option disabled selected hidden>Pilih Peminjam...</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option><?= $a['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sarpras" class="col-sm-2 col-form-label text-dark">Sarpras</label>
                    <div class="col-sm-10">
                        <select class="form-control text-dark" id="sarpras" name="sarpras" value="<?= old('sarpras', $peminjaman['sarpras']); ?>">
                            <option disabled selected hidden>Pilih Sarpras...</option>
                            <?php foreach ($sarana as $s) : ?>
                                <option><?= $s['nama']; ?></option>
                            <?php endforeach; ?>
                            <?php foreach ($prasarana as $p) : ?>
                                <option><?= $p['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tglpinjam" class="col-sm-2 col-form-label text-dark">Tanggal Pinjam</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control text-dark" id="tglpinjam" name="tglpinjam" value="<?= old('tglpinjam', $peminjaman['tglpinjam']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tglkembali" class="col-sm-2 col-form-label text-dark">Tanggal Kembali</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control text-dark" id="tglkembali" name="tglkembali" value="<?= old('tglkembali', $peminjaman['tglkembali']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label text-dark">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control text-dark" id="status" name="status" value="<?= old('status', $peminjaman['status']); ?>">
                            <option disabled selected hidden>Pilih Status...</option>
                            <option>Belum Kembali</option>
                            <option>Sudah Kembali</option>
                            <option>Terlambat</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?= $this->endSection(); ?>