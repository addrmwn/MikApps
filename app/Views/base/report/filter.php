<div class="row">
    <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title"><i data-feather="book"></i> Report Bulan <?php echo $subtitle ?> Tahun <?= $tahun ?> </h3>

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
                                                <th>Tanggal & Waktu </th>
                                                <th>Paket</th>
                                                <th>Kode voucher</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($datafilter as $row) {
                                            ?>
                                                <tr>
                                                    <td><?= $i++ ?></td>
                                                    <td><?= tanggal($row->date) ?> <?= $row->time ?></td>
                                                    <td><?= $row->service ?></td>
                                                    <td><?= $row->voucher ?></td>
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