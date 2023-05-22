<div class="row">

    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i data-feather="book"></i> Pendapatan tahun ini</h3>

                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6>Rp <?= number_format($credityears) ?></h6>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-3">
                                    <i style="font-size:15rem" data-feather="book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i data-feather="book"></i> Pendapatan bulan ini</h3>

                    </div>

                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6>Rp <?= number_format($credit) ?></h6>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-3">
                                    <i style="font-size:15rem" data-feather="book"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-col-lg-12 grid-margin stretch-card">

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Filter Data</h5>
                    </div>

                    <div class="card-body">
                        <?php
                        $session = session();
                        $errors = $session->getFlashdata('error');
                        if ($errors != null) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-close-circle"></i>
                                <?php foreach ($errors as $err) {
                                    echo $err;
                                } ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>

                            </div>

                        <?php endif ?>

                        <div class="example-content">
                            <form class="row g-3" action=" <?php echo base_url("report/filter"); ?>" role="form" method="POST">
                                <div class="col-md-6">
                                    <label for="inputbulan" class="form-label">Bulan</label>
                                    <select class="form-select" aria-label="Default select example" name="bulan">
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputtahun" class="form-label">Tahun</label>
                                    <select class="form-select" aria-label="Default select example" name="tahun">
                                        <?php foreach ($tahun as $row) : ?>

                                            <option value="<?php echo $row->tahun ?>"><?php echo $row->tahun ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-success"><i class="mdi mdi-check-circle"></i> Filter Data</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-lg-12 grid-margin stretch-card">


                <div class="card">

                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="table-responsive">

                                    <table id="dataTableExample" class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">

                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Paket</th>
                                                <th>Kode voucher</th>
                                                <th>Tanggal & Waktu </th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($voucher as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= $row->service ?></td>
                                                    <td><?= $row->voucher ?></td>
                                                    <td><?= tanggal($row->date) ?> <?= $row->time ?></td>
                                                    <td>Rp <?= number_format($row->price) ?></td>

                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>