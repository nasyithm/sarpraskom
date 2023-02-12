<!-- Nav Item - Dashboard -->
<li class="nav-item <?= $navbar['dashboard']; ?>">
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

<!-- Nav Item - Sarana -->
<li class="nav-item <?= $navbar['sarana']; ?>">
    <a class="nav-link" href="<?= base_url('sarana'); ?>">
        <i class="fas fa-fw fa-toolbox"></i>
        <span>Sarana</span></a>
</li>

<!-- Nav Item - Prasarana -->
<li class="nav-item <?= $navbar['prasarana']; ?>">
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

<!-- Nav Item - Peminjaman -->
<li class="nav-item <?= $navbar['peminjaman']; ?>">
    <a class="nav-link" href="<?= base_url('peminjaman'); ?>">
        <i class="fas fa-fw fa-shopping-basket"></i>
        <span>Peminjaman</span></a>
</li>

<!-- Nav Item - Daftar Peminjaman -->
<li class="nav-item <?= $navbar['daftarpeminjaman']; ?>">
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

<!-- Nav Item - Anggota -->
<li class="nav-item <?= $navbar['anggota']; ?>">
    <a class="nav-link" href="<?= base_url('anggota'); ?>">
        <i class="fas fa-fw fa-user"></i>
        <span>Anggota</span></a>
</li>

</ul>
<!-- End of Sidebar -->