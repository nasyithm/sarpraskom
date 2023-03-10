<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-md-inline">
        <a class="nav-link" id="sidebarToggle" role="button">
            <i class="fas fa-bars fa-lg text-primary"></i>
        </a>
    </div>

    <div class="text-center text-dark d-none d-md-inline mt-2 ml-2">
        <h5>Sistem Peminjaman Sarana Prasarana SMK Komputer Karanganyar</h5>
    </div>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-dark medium">Hi<?= ' ' . $nama . '!'; ?></span>
                <i class="fas fa-user fa-lg m-2 text-dark"></i>
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item text-dark" href="<?= base_url('profil'); ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2"></i>
                    Profil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>

</nav>
<!-- End of Topbar -->