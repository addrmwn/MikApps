<div class="row">
    <div class="col-md-12 grid-margin stretch-card">

        <div class="card">
            <div class="card-body">
                <div class="col-lg-6">
                    <div class="example">
                        <button type="button" class="btn btn-primary mb-1 mb-md-0" data-bs-toggle="modal" data-bs-target="#delete-<?= $comment[0]->comment ?>"><i class="mdi mdi-delete"></i> Hapus Semua Voucher ( <?= $comment[0]->comment ?> )</button>

                    </div>


                </div>
                <hr>

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
                <!--- Modal Delete -->
                <div class="modal fade" id="delete-<?= $comment[0]->comment ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Voucher By Comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda ingin menghapus data tersebut ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a class="btn btn-primary" href="<?= base_url(); ?>hotspot/voucher/deletevoucherbycomment/<?= $comment[0]->comment ?>">Yes</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h6 class="card-title">Data By Comment </h6>


                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Voucher</th>
                                <th>Profile </th>
                                <th>Status Voucher</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($comment as $row) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><?= $row->code ?></td>
                                    <td><?= $row->service ?></td>
                                    <?php
                                    if ($row->status == '0') {
                                        $text = 'Belum Digunakan';
                                    } else {
                                        $tex = 'Sudah digunakan';
                                    }
                                    ?>
                                    <td><?= $text ?></td>
                                </tr>


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