<?= $this->extend('layout/auth'); ?>

<?= $this->section('auth-content'); ?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-4">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block">
                    <div class="pt-5 text-center">
                        <img src="<?= base_url('assets'); ?>/img/logo.png" style="width: 100px;">
                    </div>
                    <div class="pt-4 px-5 text-center">
                        <h1 class="h2 text-primary">Sistem Peminjaman Sarana dan Prasarana SMK Komputer Karanganyar</h1>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registrasi Akun</h1>
                        </div>
                        <form class="user" action="<?= base_url('auth/simpan'); ?>" method="post">
                            <?= csrf_field(); ?>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (validation_show_error('userid')) ? 'is-invalid' : ''; ?>" id="userid" name="userid" value="<?= old('userid'); ?>" placeholder="Masukkan User ID">
                                <div class="invalid-feedback pl-3">
                                    <?= validation_show_error('userid'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama'); ?>" placeholder="Masukkan Nama">
                                <div class="invalid-feedback pl-3">
                                    <?= validation_show_error('nama'); ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Masukkan Password">
                                    <div class="invalid-feedback pl-3">
                                        <?= validation_show_error('password'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user <?= (validation_show_error('ulangpass')) ? 'is-invalid' : ''; ?>" id="ulangpass" name="ulangpass" value="<?= old('ulangpass'); ?>" placeholder="Ulangi Password">
                                    <div class="invalid-feedback pl-3">
                                        <?= validation_show_error('ulangpass'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Buat Akun
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('/'); ?>">Sudah Memiliki Akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>