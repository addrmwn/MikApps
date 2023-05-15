<div class="row">
    <!-- end row -->
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">


            <div class="card-body">
                <div class="form-group">
                    <div class="input-group">
                        <select class="form-select" aria-label="Default select example" id="comment" name="comment">
                            <option value="">Pilih Voucher</option>

                            <?php

                            foreach ($comment as $data) {
                                if ($data->comment == null) {
                            ?>
                                <?php } else { ?>

                                    <option value="<?= $data->comment; ?>"><?= $data->comment; ?></option>

                            <?php }
                            } ?>

                        </select>

                    </div>
                </div>
                <br>

                <script>
                    function printV() {
                        var comm = document.getElementById('comment').value;
                        var url = "<?= base_url('hotspot/print/default/') ?>" + comm + "";
                        if (comm === "") {
                            alert('Silakan pilih salah satu Comment terlebih dulu!');
                        } else {
                            var win = window.open(url, '_blank');
                            win.focus();
                        }
                    }
                </script>
                <script>
                    function printsmall(a, b) {
                        var comm = document.getElementById('comment').value;
                        var url = "<?= base_url('hotspot/print/small/') ?>" + comm + "";
                        if (comm === "") {
                            alert('Silakan pilih salah satu Comment terlebih dulu!');
                        } else {
                            var win = window.open(url, '_blank');
                            win.focus();
                        }
                    }
                </script>
                <script>
                    function lihat_data() {
                        var comm = document.getElementById('comment').value;
                        var url = "<?= base_url('hotspot/voucher/comment/') ?>" + comm + "";

                        if (comm === "") {
                            alert('Silakan pilih salah satu Comment terlebih dulu!');
                        } else {
                            var win = window.open(url, '_blank');
                            win.focus();
                        }
                    }
                </script>


                <div class="col-lg-6">
                    <div class="example">


                        <button type="button" class="btn btn-primary mb-1 mb-md-0" onclick="printV();"><i class="mdi mdi-printer"></i> Default</button>
                        <button type="button" class="btn btn-secondary mb-1 mb-md-0" onclick="printsmall('small','yes');"><i class="mdi mdi-printer"></i> Small</button>
                        <button type="button" class="btn btn-success mb-1 mb-md-0" onclick="lihat_data();"><i class="mdi mdi-view-list"></i> Cek data by comment</button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
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


                <h6 class="card-title">Hotspot Users</h6>

                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Voucher</th>
                                <th>Profile</th>
                                <th>Comment</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($hotspotuser as $data) {
                                $uid = $data->id;

                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $data->code ?></td>
                                    <td><?= $data->service ?></td>
                                    <td><?= $data->comment ?></td>

                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>