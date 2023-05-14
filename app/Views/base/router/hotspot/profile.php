<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
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
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="float-left">
                                    <h6 class="modal-title" id="custom-width-modalLabel"><i class="mdi mdi-account-multiple-plus"></i> Add Profile</h6>
                                </div>
                                <div class="float-right">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="<?php echo base_url('hotspot/add_profile'); ?>" role="form" method="POST">

                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" onchange="remSpace();" autocomplete="off" name="name" id="name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Rate limit [up/down]</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" autocomplete="off" name="ratelimit" id="ratelimit" placeholder="Example : 512k/1M">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Masa Aktif [ Validity ]</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" autocomplete="off" name="uptime" id="uptime" placeholder="Example : 1h/4h/7h/30d">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Harga</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="number" autocomplete="off" name="price" id="price" placeholder="Example : 1000">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Kunci Mac Address</label>
                                        <div class="col-md-12">
                                            <select class="form-select" aria-label="Default select example" name="mac" id="mac">
                                                <option disabled value="" selected>Pilih salah satu</option>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Shared Users</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" autocomplete="off" name="shared" id="shared" placeholder="Example : 1">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Kembali</button>
                                        <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="mdi mdi-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light"><i class="mdi mdi-account-multiple-plus"></i> Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <div id="sinkron" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="float-left">
                                    <h6 class="modal-title" id="custom-width-modalLabel"><i class="mdi mdi-sync"></i> Sinkronisasi Profile</h6>
                                </div>
                                <div class="float-right">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" action="<?php echo base_url('hotspot/prosessinkron'); ?>" role="form" method="POST">

                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Name</label>
                                        <div class="col-md-12">
                                            <select class="form-select" aria-label="Default select example" name="name" id="name">
                                                <option disabled value="" selected>Pilih salah satu</option>
                                                <?php foreach ($getprofilm as $data) { ?>
                                                    <option><?= $data['name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Masa Aktif [ Validity ]</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" autocomplete="off" name="uptime" id="uptime" placeholder="Example : 1h/4h/7h/30d">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Harga</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="number" autocomplete="off" name="price" id="price" placeholder="Example : 1000">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Kunci Mac Address</label>
                                        <div class="col-md-12">
                                            <select class="form-select" aria-label="Default select example" name="mac" id="mac">
                                                <option disabled value="" selected>Pilih salah satu</option>
                                                <option value="Ya">Ya</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12 control-label"> Shared Users</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="text" autocomplete="off" name="shared" id="shared" placeholder="Example : 1">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Kembali</button>
                                        <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal"><i class="mdi mdi-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light"><i class="mdi mdi-sync"></i> Proses Sinkron</button>
                                    </div>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <h6 class="card-title">Hotspot Profile</h6>
                <div class="col-lg-6">
                    <div class="example">


                        <button type="button" class="btn btn-primary mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#myModal"><i class="mdi mdi-account-multiple-plus"></i> Add Profile</button>
                        <button type="button" class="btn btn-secondary mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#sinkron"><i class="mdi mdi-sync"></i> Sinkronisasi Profile</button>
                    </div>


                </div>
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Shared Users</th>
                                <th>Rate Limit</th>
                                <th>Uptime</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($getprofile as $row) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><?= $row->service ?></td>
                                    <td><?= $row->shared ?></td>
                                    <td><?= $row->ratelimit ?></td>
                                    <td><?= $row->uptime ?></td>
                                    <td>Rp <?= number_format($row->price) ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#delete-<?= $row->id ?>"><i class="mdi mdi-delete"></i> Delete Profile </button>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#edit-<?= $row->id ?>"><i class="mdi mdi-grease-pencil"></i> Edit Profile </button>
                                    </td>
                                </tr>
                                <!--- Modal Delete -->
                                <div class="modal fade" id="delete-<?= $row->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Profile</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah ingin menghapus profile <b><u><?= $row->service ?></u></b> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                                <a class="btn btn-primary" href="<?= base_url(); ?>hotspot/delete_profile/<?= $row->service ?>">Ya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--- Modal Edit -->
                                <div class="modal fade" id="edit-<?= $row->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Profile</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="form-horizontal" action="<?php echo base_url(); ?>hotspot/edit_profile/<?= $row->service ?>" role="form" method="POST">

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Name</label>
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" onchange="remSpace();" autocomplete="off" name="name" value="<?= $row->service ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label"> Rate limit [up/down]</label>
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="text" autocomplete="off" name="ratelimit" value="<?= $row->ratelimit ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label"> Masa Aktif [ Validity ]</label>
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="text" autocomplete="off" name="uptime" value="<?= $row->uptime ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label"> Harga</label>
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="number" autocomplete="off" name="price" value="<?= $row->price ?>">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label">Kunci Mac Address</label>
                                                        <div class="col-md-12">
                                                            <select class="form-select" aria-label="Default select example" name="mac">
                                                                <option disabled value="" selected>Pilih salah satu</option>
                                                                <option value="Ya">Ya</option>
                                                                <option value="Tidak">Tidak</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 control-label"> Shared Users</label>
                                                        <div class="col-md-12">
                                                            <input class="form-control" type="text" autocomplete="off" name="shared" value="<?= $row->shared ?>">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Kembali</button>
                                                        <button type="submit" class="btn btn-success btn-bordered waves-effect w-md waves-light"><i class="mdi mdi-check-circle"></i> Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function remSpace() {
        var upName = document.getElementsByName("name")[0];
        var newUpName = upName.value.replace(/\s/g, "-");
        upName.value = newUpName;
        upName.focus();
    }
</script>