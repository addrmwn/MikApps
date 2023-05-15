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



                $url = urlencode('http://' . $dns . '/login?username' . $data->code . '&password=' . $data->code);

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
                <!--mks-mulai-->
                <style>
                    .qrcode {
                        height: 60px;
                        width: 60px;
                    }
                </style>
                <table style="display: inline-block;border-collapse: collapse;border: 1px solid #666;margin: 2.5px;width: 190px;overflow:hidden;position:relative;padding: 0px;margin: 2px;border: 1px solid #000000;">
                    <tbody>
                        <tr>
                            <td style="color:#666;" valign="top">
                                <table style="width:100%;">
                                    <tbody>
                                        <tr>
                                            <td style="width:75px">
                                                <div style="position:relative;z-index:-1;padding: 0px;float:left;">
                                                    <div style="position:absolute;top:0;display:inline;margin-top:-100px;width: 0; height: 0; border-top: 230px solid transparent;border-left: 50px solid transparent;border-right:140px solid #DCDCDC; "></div>
                                                </div>

                                                <img style="margin:5px 0 0 5px;" width="85" height="20" src="<?= base_url() ?>assets/images/mikapps-black.png" alt="logo">

                                            </td>
                                            <td style="width:115px">
                                                <div style="float:right;margin-top:-6px;margin-right:0px;width:5%;text-align:right;font-size:7px;">
                                                </div>
                                                <div style="text-align:right;font-weight:bold;font-family:Tahoma;font-size:15px;padding-left:17px;color:<?php echo $color ?>">Rp <?= number_format($getsprice); ?>

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="color:#666;border-collapse: collapse;" valign="top">
                                <table style="width:100%;border-collapse: collapse;">
                                    <tbody>
                                        <tr>
                                            <td style="width:95px" valign="top">
                                                <div style="clear:both;color:#555;margin-top:2px;margin-bottom:2.5px;">
                                                    <div style="padding:0px;border-bottom:1px solid<?php echo $color ?>;text-align:center;font-weight:bold;font-size:10px;">VOUCHER</div>
                                                    <div style="padding:0px;border-bottom:1px solid<?php echo $color ?>;text-align:center;font-weight:bold;font-size:14px;;color:#000000;"><?= $data->code ?></div>
                                                </div>
                                                <div style="text-align:center;color:#111;font-size:8px;font-weight:bold;margin:0px;padding:2.5px;">
                                                    Hubungkan ke Wifi FIBER DELTA NETWORK
                                                </div>
                                            </td>
                                            <td style="width:100px;text-align:right;">
                                                <div style="clear:both;padding:0 2.5px;font-size:15px;font-weight:bold;color:#000000">
                                                    <?php echo $timelimit; ?>
                                                </div>
                                                <canvas class='qrcode' id='Rand<?= $num ?>'></canvas>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background:<?php echo $color ?>;color:#666;padding:0px;" valign="top" colspan="2">
                                                <div style="text-align:left;color:#fff;font-size:9px;font-weight:bold;margin:0px;padding:2.5px;">
                                                    Login: http://<?= $dns ?> <span id="num"> <?= " [$num]"; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--mks-akhir-->

                <script src="<?php echo base_url() ?>assets/js/qrious.min.js"></script>

                <script>
                    (function() {
                        var Rand<?= $num ?> = new QRious({
                            element: document.getElementById('Rand<?= $num ?>'),
                            value: '<?= $url ?>',
                            foreground: 'black',
                            size: '256'
                        });
                    })();
                </script>
    <?php }
        }
    } ?>