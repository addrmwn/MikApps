                    <!-- ROW -->
                    <div class="row">
                        <div class="col">
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

                            <div class="card overflow-hidden">

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title"><i class="fe fe-cpu"></i> Add Router</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" name="formedit" action="<?php echo base_url('router/do_add_router'); ?>">
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-server-network text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_name" placeholder="Nama Server. Cth : MikApps" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-cloud text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_dns" placeholder="DNS Name. Cth : mikapps.net" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-dns text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_host" placeholder="IP / Host Mikrotik" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-account text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="router_user" placeholder="Username" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-lock text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="password" name="router_pass" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <a class="input-group-text bg-white">
                                                    <i class="mdi mdi-slack text-muted"></i>
                                                </a>
                                                <input class="input100 form-control " type="text" name="traffic_interface" placeholder="Traffic Interface. Cth : ether1" required>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="wrap-input100 input-group">
                                                <button class="btn btn-primary" id="simpanedit" type="submit"><i class="mdi mdi-near-me"></i> Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <!-- COL END -->
                    </div>
                    <!-- ROW END -->