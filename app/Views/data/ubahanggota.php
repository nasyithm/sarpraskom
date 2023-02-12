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
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Anggota</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk mengubah data anggota.</p>

            <form action="<?= base_url('anggota/update'); ?>/<?= $anggota['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="nis" class="col-sm-2 col-form-label text-dark">NIS</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark <?= (validation_show_error('nis')) ? 'is-invalid' : ''; ?>" id="nis" name="nis" value="<?= old('nis', $anggota['nis']); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('nis'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label text-dark">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark" id="nama" name="nama" value="<?= old('nama', $anggota['nama']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label text-dark">Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark" id="kelas" name="kelas" value="<?= old('kelas', $anggota['kelas']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nohp" class="col-sm-2 col-form-label text-dark">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark" id="nohp" name="nohp" value="<?= old('nohp', $anggota['nohp']); ?>">
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