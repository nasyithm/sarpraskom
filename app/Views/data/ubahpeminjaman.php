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
<li class="nav-item active">
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
            <h1 class="h3 mb-2 text-gray-800">Ubah Data Peminjaman</h1>
            <p class="mb-4">Silahkan isi form dibawah untuk mengubah data peminjaman.</p>

            <form action="<?= base_url('daftarpeminjaman/update'); ?>/<?= $peminjaman['id']; ?>" method="post">
                <?= csrf_field(); ?>
                <div class="form-group row">
                    <label for="idpeminjaman" class="col-sm-2 col-form-label">ID Peminjaman</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= (validation_show_error('idpeminjaman')) ? 'is-invalid' : ''; ?>" id="idpeminjaman" name="idpeminjaman" value="<?= old('idpeminjaman', $peminjaman['idpeminjaman']); ?>" autofocus>
                        <div class="invalid-feedback">
                            <?= validation_show_error('idpeminjaman'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="peminjam" class="col-sm-2 col-form-label">Peminjam</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="peminjam" name="peminjam" value="<?= old('peminjam', $peminjaman['peminjam']); ?>">
                            <option disabled selected hidden>Pilih Peminjam...</option>
                            <?php foreach ($anggota as $a) : ?>
                                <option><?= $a['nama']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="sarpras" class="col-sm-2 col-form-label">Sarpras</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="sarpras" name="sarpras" value="<?= old('sarpras', $peminjaman['sarpras']); ?>">
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
                    <label for="tglpinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tglpinjam" name="tglpinjam" value="<?= old('tglpinjam', $peminjaman['tglpinjam']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tglkembali" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tglkembali" name="tglkembali" value="<?= old('tglkembali', $peminjaman['tglkembali']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="status" name="status" value="<?= old('status', $peminjaman['status']); ?>">
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