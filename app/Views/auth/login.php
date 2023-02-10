<?= $this->extend('layout/auth'); ?>

<?= $this->section('auth-content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="pt-5 text-center">
                                <img src="<?= base_url('assets'); ?>/img/logo.png" style="width: 100px;">
                            </div>
                            <div class="pt-3 pl-5 pr-5 text-center">
                                <h1 class="h2 text-primary">Sistem Peminjaman Sarana dan Prasarana SMK Komputer Karanganyar</h1>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Login Akun</h1>
                                </div>

                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success" role="alert">
                                        <?= session()->getFlashdata('pesan') ?>
                                    </div>
                                <?php endif; ?>

                                <form class="user" action="<?= base_url('auth/login'); ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user <?= (validation_show_error('userid') || $msg_user) ? 'is-invalid' : ''; ?>" id="userid" name="userid" value="<?= old('userid'); ?>" placeholder="Masukkan User ID">
                                        <div class="invalid-feedback pl-3">
                                            <?= validation_show_error('userid'); ?>
                                            <?= $msg_user; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user <?= (validation_show_error('password') || $msg_pass) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Masukkan Password">
                                        <div class="invalid-feedback pl-3">
                                            <?= validation_show_error('password'); ?>
                                            <?= $msg_pass; ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <!-- <div class="text-center">
                                    <a class="small" href="forgot-password.html">Lupa Password?</a>
                                </div> -->
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('registrasi'); ?>">Buat Akun Baru!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>