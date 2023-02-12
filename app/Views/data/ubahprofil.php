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
            <h1 class="h3 mb-2 text-gray-800">Ubah Profil</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk mengubah profil Anda.</p>

            <form action="<?= base_url('profil/update'); ?>/<?= $id; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="userid" class="col-sm-2 col-form-label text-dark">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark <?= (validation_show_error('userid')) ? 'is-invalid' : ''; ?>" id="userid" name="userid" value="<?= old('userid', $userid); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('userid'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label text-dark">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-dark <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama', $nama); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spesifikasi" class="col-sm-2 col-form-label text-dark">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control text-dark <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label text-dark">Ulangi Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control text-dark <?= (validation_show_error('ulangpass')) ? 'is-invalid' : ''; ?>" id="ulangpass" name="ulangpass">
                        <div class="invalid-feedback">
                            <?= validation_show_error('ulangpass'); ?>
                        </div>
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