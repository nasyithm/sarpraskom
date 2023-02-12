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
            <h1 class="h3 mb-2 text-gray-800">Tambah Data Prasarana</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk menambahkan data prasarana.</p>

            <form action="<?= base_url('prasarana/simpan'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="kode" class="col-sm-2 col-form-label text-dark">Kode</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark <?= (validation_show_error('kode')) ? 'is-invalid' : ''; ?>" id="kode" name="kode" value="<?= old('kode'); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kode'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label text-dark">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark" id="nama" name="nama" value="<?= old('nama'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spesifikasi" class="col-sm-2 col-form-label text-dark">Spesifikasi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark" id="spesifikasi" name="spesifikasi" value="<?= old('spesifikasi'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label text-dark">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control text-dark" id="jumlah" name="jumlah" value="<?= old('jumlah'); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    <?= $this->endSection(); ?>