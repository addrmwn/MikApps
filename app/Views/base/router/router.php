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

                            <div class="card">


                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="mdi mdi-dns"></i> Router List</h3>
                                    <?php if (count($router) > 0) {
                                    ?>
                                    <?php } else { ?>
                                        <a href="addrouter" class="btn btn-sm btn-primary">Add Router</a>
                                    <?php } ?>
                                </div>
                                <div class="card-body">
                                    <?php foreach ($router as $row) { ?>
                                        <div class="card ">
                                            <div class="card-body border border-primary border-3 ">
                                                <form style="display:inline !important;" id="" action="do_auth_router" method="post">
                                                    <input type="hidden" value="<?= $row->id ?>" name="router_id" />
                                                    <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->nama ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                        <i style="font-size:2rem" class="mdi mdi-dns"></i>
                                                    </a>
                                                </form>
                                                <div class="media-body valign-middle">
                                                    <form style="display:inline !important;" class="me-3" id="" action="do_auth_router" method="post">
                                                        <input type="hidden" value="<?= $row->id ?>" name="router_id" />
                                                        <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->nama ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                            <?= $row->nama ?>
                                                        </a>
                                                    </form>
                                                    <p class="text-muted mb-0"><?= $row->dns ?></p>

                                                    <form style="display:inline !important;" class="me-3" id="" action="do_auth_router" method="post">
                                                        <input type="hidden" value="<?= $row->id ?>" name="router_id" />
                                                        <a class="text-white" href="#/" onclick="Swal.fire({text: 'Login to <?= $row->nama ?> ',allowOutsideClick: false,showConfirmButton: false,didOpen: () => {Swal.showLoading();this.closest('form').submit();return false;},})">
                                                            <i class="mdi mdi-link-variant"></i> Open
                                                        </a>
                                                    </form>

                                                    <a class="text-white me-3" href="#/" data-bs-toggle="modal" data-bs-target="#editModal" data-router_id="<?= $row->id ?>" data-router_name="<?= $row->nama ?>" data-router_host="<?= $row->ip ?>" data-router_user="<?= $row->username ?>" data-router_pass="<?= decrypt($row->password) ?>" data-router_dns="<?= $row->dns ?>" data-traffic_interface="<?= $row->traffic_interface ?>">
                                                        <i class="mdi mdi-pencil-box-outline"></i> Edit
                                                    </a>


                                                    <form style="display:inline !important;" class="me-3" id="" action="delete_router" method="post">
                                                        <input type="hidden" value="<?= $row->id ?>" name="router_id" />
                                                        <a class="text-white me-3" href="#/" onclick="Swal.fire({title: 'Delete <?= $row->nama ?>?',text: 'Data Router ini akan terhapus!',icon: 'warning',showCancelButton: true,cancelButtonColor: '#d33',confirmButtonText: 'Yes, delete it!'}).then((result) => {if (result.isConfirmed) {this.closest('form').submit();return false;}})">
                                                            <i class="mdi mdi-delete"></i> Delete
                                                        </a>
                                                    </form>



                                                </div>
                                            </div>
                                        </div>

                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <!-- COL END -->
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card overflow-hidden">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="mdi mdi-account"></i> Authentication Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="<?php echo base_url('router/update_user'); ?>">
                                        <div class="mb-3">
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                <a href="javascript:void(0)" class="input-group-text bg-white">
                                                    <i class="mdi mdi-account text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="username" value="<?= $_SESSION['username']; ?>">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                <a href="javascript:void(0)" class="input-group-text bg-white">
                                                    <i class="mdi mdi-lock text-muted" aria-hidden="true"></i>
                                                </a>
                                                <input class="input100 form-control" type="password" name="password" placeholder="New Password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="wrap-input100 validate-input input-group" id="Password-toggle1">
                                                <button type="submit" class="btn btn-primary btn-sm" id="btnsave"><i class="mdi mdi-near-me"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- COL END -->

                    </div>
                    <!-- ROW END -->

                    <!-- Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel"><i class="mdi mdi-dns"></i> <span id="rname"></span></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" name="formedit" action="<?php echo base_url('router/edit_router'); ?>">
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-server-network text-muted"></i>
                                                </a>
                                                <input type="hidden" name="router_id" id="router_id" placeholder="Nama Server. Cth : MikApps" required>
                                                <input class="input100 form-control " type="text" name="router_name" id="router_name" placeholder="Nama Server. Cth : MikApps" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">


                                                    <i class="mdi mdi-cloud text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_dns" id="router_dns" placeholder="DNS Name. Cth : mikapps.net" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-dns text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_host" id="router_host" placeholder="IP / Host Mikrotik" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-account text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_user" id="router_user" placeholder="Username" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-lock text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_pass" id="router_pass" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-slack text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="traffic_interface" id="traffic_interface" placeholder="Traffic Interface. Cth : ether1" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <button class="btn btn-primary btn-sm" id="simpanedit" type="submit"><i class="mdi mdi-near-me"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>