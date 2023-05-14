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


                <h6 class="card-title">Hotspot Active</h6>

                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th><?= $totalhotspotactive ?></th>
                                <th>Server</th>
                                <th>User</th>
                                <th>Mac Address</th>
                                <th>Uptime</th>
                                <th>Bytes In</th>
                                <th>Bytes Out</th>
                                <th>Time Left</th>
                                <th>Login By</th>
                                <th>Comment</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($hotspotactive as $data) {
                            ?>
                                <tr>
                                    <td>
                                        <?= $i++ ?>
                                    </td>
                                    <td><?= $data['server'] ?></td>
                                    <td><?= $data['user'] ?></td>
                                    <td><?= $data['mac-address'] ?></td>
                                    <td><?= formatDTM($data['uptime']) ?></td>
                                    <td><?= formatBytes($data['bytes-in']) ?></td>
                                    <td><?= formatBytes($data['bytes-out']) ?></td>

                                    <?php
                                    if (isset($data['session-time-left'])) {
                                        $timeleft = formatDTM($data['session-time-left']);
                                    } else {
                                        $timeleft = 'Tidak ada waktu habis';
                                    }
                                    ?>


                                    <td><?= $timeleft ?></td>
                                    <td><?= $data['login-by'] ?></td>
                                    <?php
                                    if (isset($data['comment'])) {
                                        $text = $data['comment'];
                                    } else {
                                        $text = 'Tidak ada comment';
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