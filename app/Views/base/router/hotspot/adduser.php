                    <!-- ROW -->
                    <div class="row">
                        <?php
                        $session = session();
                        $errors = $session->getFlashdata('error');
                        if ($errors != null) : ?>
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                                <i class="fa fa-frown-o me-2" aria-hidden="true"></i>
                                <?php foreach ($errors as $err) {
                                    echo $err;
                                } ?>
                            </div>
                        <?php endif ?>

                        <?php
                        $session = session();
                        $success = $session->getFlashdata('success');
                        if ($success != null) : ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-check-circle me-2" aria-hidden="true"></i>

                                <?php foreach ($success as $suc) {
                                    echo $suc;
                                } ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>


                        <?php endif ?>
                        <div class="col-lg-6 grid-margin stretch-card">

                            <div class="card overflow-hidden">

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="mdi mdi-account"></i> Add User Custom Code</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?php echo base_url('hotspot/prosesadduser'); ?>">

                                        <div class="form-group mb-3">
                                            <label class="col-md-12 control-label"> Custom Code</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" autocomplete="off" name="code" id="code" placeholder="Masukan kode voucher yang ingin dibuat">
                                            </div>
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="col-md-12 control-label">Server</label>
                                            <div class="col-md-12">
                                                <select class="form-select" aria-label="Default select example" name="server" id="server">
                                                    <option disabled value="" selected>Pilih Server</option>
                                                    <option value="all">all</option>
                                                    <?php foreach ($server as $data) { ?>
                                                        <option><?= $data['name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group mb-3">
                                            <label class="col-md-12 control-label">Profile</label>
                                            <div class="col-md-12">
                                                <select class="form-select" aria-label="Default select example" name="profile" id="profile">
                                                    <option disabled value="" selected>Pilih Profile</option>
                                                    <?php foreach ($profile as $data) { ?>
                                                        <option value="<?= $data->service ?>"><?= $data->service ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="col-md-12 control-label"> TimeLimit ( Waktu Aktif Voucher )</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="text" autocomplete="off" name="timelimit" id="timelimit" placeholder="Example : 1h/3h/1d/3d/7d">
                                            </div>
                                        </div>


                                        <div class="form-group mb-3">
                                            <button type="submit" class="btn btn-primary btn-bordered waves-effect w-md waves-light"><i class="mdi mdi-check-circle"></i> Submit</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- COL END -->

                        <div class="col-lg-6 ">
                            <div class="card">

                                <div class="card-header">
                                    <h3 class="card-title"><i class="mdi mdi-bullhorn"></i> Information</h3>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        <li>Custom Code tidak boleh menggunakan spasi, gunakan simbol strip untuk mengubah spasi</li>
                                        <li>Timelimit tidak boleh lebih besar dari validity, jika anda ragu mohon tidak mengisikan timelimit</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ROW END -->