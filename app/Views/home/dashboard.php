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
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>

            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Sarana</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= count($sarana); ?> Buah</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-toolbox fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Prasarana</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= count($prasarana); ?> Buah</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-school fa-2x text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Daftar Peminjaman</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= count($peminjaman); ?> Peminjaman</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-list fa-2x text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Anggota</div>
                                    <div class="h5 mb-0 font-weight-bold text-dark"><?= count($anggota); ?> Orang</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Diagram Statistik Peminjaman Bulan <?php
                    $bulanIni = new DateTime();
                    echo strftime('%B', $bulanIni->getTimestamp()); ?></h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <script>
                            <?php
                            $labeldia = "";
                            $datadia = "";
                            $minggu = [
                                '1' => 0,
                                '2' => 0,
                                '3' => 0,
                                '4' => 0
                            ];

                            for ($i = 1; $i <= 4; $i++) {
                                $labeldia .= '"Minggu Ke-' . $i . '",';
                            }

                            foreach ($peminjaman as $p) {
                                $h = (int) date('d', strtotime($p['tglpinjam']));
                                $b = (int) date('m', strtotime($p['tglpinjam']));
                                if ($b == date('m')) {
                                    if ($h <= 7) {
                                        $minggu['1']++;
                                    } elseif ($h > 7 && $h <= 14) {
                                        $minggu['2']++;
                                    } elseif ($h > 14 && $h <= 21) {
                                        $minggu['3']++;
                                    } elseif ($h > 14 && $h <= 31) {
                                        $minggu['4']++;
                                    }
                                }
                            }
                            
                            foreach ($minggu as $m) {
                                $datadia .= '"' . $m . '",';
                            }

                            $labeldia = rtrim($labeldia, ",");
                            $datadia = rtrim($datadia, ",");
                            echo "var labeldia = [$labeldia];";
                            echo "var datadia = [$datadia];";
                            ?>
                        </script>
                        <canvas id="diagramArea"></canvas>
                    </div>
                    <hr>
                    Diagram ini menampilkan data statistik jumlah peminjaman bulan ini pada setiap minggu.
                </div>
            </div>
        </div>
        <!--/.container-fluid -->

    </div>
    <!--End of Main Content-->

    <?= $this->endSection(); ?>