<?php


namespace App\Controllers\base;

use App\Controllers\BaseController;
use App\Models\base\DashboardModel;
use App\Libraries\RouterosAPI;
use CodeIgniter\I18n\Time;

class AutoController extends BaseController
{

    public function __construct()
    {
        $this->ros = new RouterosAPI();
    }


    public function cekvoucher()
    {
        $date = Time::now('Asia/Jakarta');
        $datenya = Time::now('Asia/Jakarta', 'Y-m-d');
        $timenya = Time::now('Asia/Jakarta', 'H:i:s');

        $dashboardmodel = new DashboardModel;
        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        $voucheractive = $dashboardmodel->statusvoucher();


        foreach ($voucheractive as $voucher) {

            $kode = $voucher->code;
            $profile = $voucher->service;
            $price = $voucher->price;


            if ($this->ros->connect($host, $uname, $pass)) {

                $gethotspot = $this->ros->comm("/ip/hotspot/active/print");

                $hotspotactive = $gethotspot;

                foreach ($hotspotactive as $activeuser) {
                    $enabled = $activeuser['user'];

                    $voucherctive = $enabled;


                    if ($kode == $voucherctive) {

                        $dashboardmodel->deletevouchersingle($kode);

                        $datanya = array(
                            'service' => $profile,
                            'voucher' => $kode,
                            'price' => $price,
                            'date' => $datenya,
                            'time' => $timenya,
                        );
                        $dashboardmodel->insertreport($datanya);
                        echo "<font color='green'><b>Voucher : $kode | Status : Berhasil Di Update  </font><br><br>";
                    } else {
                        echo "<font color='red'><b>Voucher : $kode | Status : Belum aktif pada mikrotik hotspot </font><br><br>";
                    }
                }
            } else {
            }
        }
    }
}
