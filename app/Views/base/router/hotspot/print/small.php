<html>

<head>
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/favicon.png" />

    <style>
        body {
            color: #000000;
            background-color: #FFFFFF;
            font-size: 14px;
            font-family: 'Helvetica', arial, sans-serif;
            margin: 0px;
            -webkit-print-color-adjust: exact;
        }

        table.voucher {
            display: inline-block;
            border: 2px solid black;
            margin: 2px;
        }

        #num {
            float: right;
            display: inline-block;
        }

        .qrc {
            width: 30px;
            height: 30px;
            margin-top: 1px;
        }

        @page {
            size: auto;
            margin-left: 7mm;
            margin-right: 3mm;
            margin-top: 9mm;
            margin-bottom: 3mm;
        }

        @media print {
            table {
                page-break-after: auto
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto
            }

            td {
                page-break-inside: avoid;
                page-break-after: auto
            }

            thead {
                display: table-header-group
            }

            tfoot {
                display: table-footer-group
            }
        }

        .rotate {
            vertical-align: bottom;
            text-align: center;
        }

        .rotate span {
            -ms-writing-mode: tb-rl;
            -webkit-writing-mode: vertical-rl;
            writing-mode: vertical-rl;
            transform: rotate(180deg);
            white-space: nowrap;
        }

        .qrcode {
            height: 60px;
            width: 60px;
        }
    </style>
</head>

<body onload="print()">
    <?php

    $count = 1;

    foreach ($comment as $data) {

        $num = $count++;

        foreach ($service as $dataserv) {

            foreach ($router as $datarouter) {
                $dns = $datarouter->dns;
                $hotspotname = $datarouter->nama;

                $timelimit = $dataserv->uptime;
                $getsprice = $dataserv->price;

                if (substr($timelimit, -1) == "d" & strlen($timelimit) > 3) {
                    $timelimit = "Durasi :" . ((substr($timelimit, 0, -1) * 7) +  substr($timelimit, 2, 1)) . " HARI";
                } else if (substr($timelimit, -1) == "d") {
                    $timelimit = "Durasi :" . substr($timelimit, 0, -1) . " HARI";
                } else if (substr($timelimit, -1) == "h") {
                    $timelimit = "Durasi :" . substr($timelimit, 0, -1) . " Jam";
                } else if (substr($timelimit, -1) == "w") {
                    $timelimit = "Durasi :" . (substr($timelimit, 0, -1) * 7) . " HARI";
                }



                if ($getsprice == "3000") {
                    $color = "#666";
                } // jika harga == "1000" maka warna = "#01579B"
                elseif ($getsprice == "1000") {
                    $color = "#FF1493";
                } elseif ($getsprice == "2000") {
                    $color = "#8B008B";
                } elseif ($getsprice == "3000") {
                    $color = "#666";
                } elseif ($getsprice == "5000") {
                    $color = "#FF4500";
                } elseif ($getsprice == "10000") {
                    $color = "#E65100";
                } elseif ($getsprice == "15000") {
                    $color = "#228B22";
                } elseif ($getsprice == "20000") {
                    $color = "#008000";
                } elseif ($getsprice == "30000") {
                    $color = "#FF00FF";
                } elseif ($getsprice == "60000") {
                    $color = "#E60C00";
                } elseif ($getsprice == "70000") {
                    $color = "#FF0000";
                } else {
                    $color = "#BA68C8";
                }



    ?>

                <table class="voucher" style=" width: 170px;">
                    <tbody>
                        <tr>
                            <td style="text-align: left; font-size: 12px; font-weight:bold; border-bottom: 1px black solid;"><?php echo $hotspotname; ?> <span id="num"><?php echo " [$num]"; ?></span></td>
                        </tr>
                        <tr>
                            <td>
                                <table style=" text-align: center; width: 150px;">
                                    <tbody>
                                        <tr style="color: black; font-size: 11px;">
                                            <td>
                                                <table style="width:100%;">
                                                    <!-- Username = Password    -->
                                                    <tr style="color: black; font-size: 12px; text-align: center;">
                                                        <td>Kode Voucher</td>
                                                    </tr>
                                                    <tr style="color: black; font-size: 14px;">
                                                        <td style="width:100%; border: 1px solid black; font-weight:bold; text-align: center;"><?php echo $data->code; ?></td>
                                                    </tr>
                                                    <tr style="color: black; font-size: 12px;">
                                                        <td colspan="2" style="width:100%; border: 1px solid black; font-weight:bold; text-align: center;"><?php echo $timelimit; ?> Rp <?= number_format($getsprice); ?></td>
                                                    </tr>
                                                    <!-- /  -->

                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
    <?php }
        }
    } ?>