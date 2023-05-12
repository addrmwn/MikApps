<?php

namespace App\Models\base;

use \RouterOS\Client;
use \RouterOS\Query;
use RouterOS\Config;

class RouterModel
{
    public function __construct()
    {
        $this->DashboardModel = new DashboardModel();
        $this->session = session();
        $rosauth = $this->DashboardModel->get_router();
        $this->config = new Config([
            'host' => explode(":", $rosauth[0]->ip)[0],
            'user' => $rosauth[0]->username,
            'pass' => decrypt($rosauth[0]->password),
            'port' => (int) explode(":", $rosauth[0]->ip)[1],
            'timeout' => 3,
            'attempts' => 5,
            'delay' => 3,
            'socket_timeout' => 30,
            'socket_blocking' => false,
            'socket_options' => [
                'tcp_nodelay' => true
            ]
        ]);
    }

    public function dashboard()
    {
        $this->ros = new Client($this->config);
        $query = new Query('/ip/hotspot/user/print');
        $query->equal('count-only');
        $hotspot_user = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/ip/hotspot/active/print');
        $query->equal('count-only');
        $hotspot_active = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/system/resource/print');
        $resource = $this->ros->qr($query);
        $model =  $resource[0]['board-name'];
        $ver =  $resource[0]['version'];
        $query = new Query('/system/clock/print');
        $sysdt = $this->ros->qr($query);
        $sysdate = $sysdt[0]['date'];
        $systime = $sysdt[0]['time'];
        $query = new Query('/ppp/secret/print');
        $query->equal('count-only');
        $ppp_secret = $this->ros->qr($query)['after']['ret'];
        $query = new Query('/ppp/active/print');
        $query->equal('count-only');
        $ppp_active = $this->ros->qr($query)['after']['ret'];
        return array(
            'hotspot_user' => $hotspot_user,
            'hotspot_active' => $hotspot_active,
            'model' => $model,
            'ver' => $ver,
            'sysdate' => $sysdate,
            'systime' => $systime,
            'ppp_secret' => $ppp_secret,
            'ppp_active' => $ppp_active,
        );
    }
}
