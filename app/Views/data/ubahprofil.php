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

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

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
            <h1 class="h3 mb-2 text-gray-800">Ubah Profil</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk mengubah profil Anda.</p>

            <form action="<?= base_url('profil/update'); ?>/<?= $id; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="userid" class="col-sm-2 col-form-label">User ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('userid')) ? 'is-invalid' : ''; ?>" id="userid" name="userid" value="<?= old('userid', $userid); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('userid'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('nama')) ? 'is-invalid' : ''; ?>" id="nama" name="nama" value="<?= old('nama', $nama); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="spesifikasi" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jumlah" class="col-sm-2 col-form-label">Ulangi Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control <?= (validation_show_error('ulangpass')) ? 'is-invalid' : ''; ?>" id="ulangpass" name="ulangpass">
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