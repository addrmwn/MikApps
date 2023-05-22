<?php


namespace App\Controllers\base;

use App\Controllers\BaseController;
use App\Models\base\DashboardModel;
use App\Libraries\RouterosAPI;
use CodeIgniter\I18n\Time;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends BaseController
{

    public function __construct()
    {
        $this->session = session();
        $this->request = \Config\Services::request();
        $this->uri = $this->request->uri;
        $this->ros = new RouterosAPI();
    }

    public function auth()
    {
        $dashboardmodel = new DashboardModel;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $dashboardmodel->getuser($username)->getRowArray();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'nomor' => $user['nomor'],
                    'status' => 'login',
                ];
                $this->session->set($data);
                return redirect()->to(base_url('router/list'));
            } else {
                $this->session->setFlashdata('errors', ['Password salah']);
                return redirect()->to(base_url('/'));
            }
        } else {
            $this->session->setFlashdata('errors', ['Username tidak terdaftar']);
            return redirect()->to(base_url('/'));
        }
    }


    public function index()
    {
        if (session()->has('status', 'login')) {
            return redirect()->to(base_url('router/list'));
        }
        $data['title'] = 'Login';
        return view('base/auth/login', $data);
    }

    public function router()
    {
        $dashboardmodel = new DashboardModel;

        $data = [
            'title' => 'Router',
            'router' => $dashboardmodel->get_router(),
            'view' => 'base/router/router',
        ];
        return view('base/router/layout', $data);
    }

    public function add_router()
    {
        $data['title'] = 'Add Router';
        $data['view'] = 'base/router/addrouter';
        return view('base/router/layout', $data);
    }


    public function do_add_router()
    {
        $dashboardmodel = new DashboardModel;

        $userid = $_SESSION['id'];

        if ($this->ros->connect($this->request->getPost('router_host'), $this->request->getPost('router_user'), $this->request->getPost('router_pass'))) {
            $getntp = $this->ros->comm("/system/clock/print", array());
            $router_ntp = $getntp[0]['time-zone-name'];
            $this->ros->disconnect();

            $saverouter = [
                'nama' => $this->request->getPost('router_name'),
                'dns' => $this->request->getPost('router_dns'),
                'ip' => $this->request->getPost('router_host'),
                'username' => $this->request->getPost('router_user'),
                'password' => encrypt($this->request->getPost('router_pass')),
                'traffic_interface' => $this->request->getPost('traffic_interface'),
            ];
            $save = $dashboardmodel->do_add_router($saverouter);

            if ($save) {
                $this->session->setFlashdata('success', ['Router Berhasil ditambahkan']);
                return redirect()->to(base_url('router/list'));
            } else {
                $this->session->setFlashdata('error', ['Router gagal ditambahkan periksa kembali autentikasi']);
                return redirect()->to(base_url('router/addrouter'));
            }
        } else {
            $this->session->setFlashdata('error', ['Router gagal ditambahkan periksa kembali autentikasi']);
            return redirect()->to(base_url('router/addrouter'));
        }
    }


    public function edit_router()
    {
        $dashboardmodel = new DashboardModel;

        $router_id = $this->request->getPost('router_id');
        $this->ros->connect($this->request->getPost('router_host'), $this->request->getPost('router_user'), $this->request->getPost('router_pass'));
        $getntp = $this->ros->comm("/system/clock/print", array());
        $router_ntp = $getntp[0]['time-zone-name'];
        $this->ros->disconnect();
        $data = [
            'nama' => $this->request->getPost('router_name'),
            'dns' => $this->request->getPost('router_dns'),
            'ip' => $this->request->getPost('router_host'),
            'username' => $this->request->getPost('router_user'),
            'password' => encrypt($this->request->getPost('router_pass')),
            'traffic_interface' => $this->request->getPost('traffic_interface'),
        ];
        $save = $dashboardmodel->edit_router($data, $router_id);
        if ($save) {
            $this->session->setFlashdata('success', ['Router Berhasil Di Edit']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Gagal']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function delete_router()
    {
        $dashboardmodel = new DashboardModel;

        $router_id = $this->request->getPost('router_id');
        $save = $dashboardmodel->delete_router($router_id);
        if ($save) {
            $this->session->setFlashdata('success', ['Router dihapus!']);
            return redirect()->to(base_url('router/list'));
        } else {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function do_auth_router()
    {
        $dashboardmodel = new DashboardModel;

        $data['id'] = $this->request->getPost('router_id');
        $get = $dashboardmodel->auth_router($data);

        if (count($get) > 0) {
            // set session
            $sess_data = array(
                'routerlogged' => TRUE,
                'router_id' => $get[0]->id,
                'traffic_interface' => $get[0]->traffic_interface,
            );
            $this->session->set($sess_data);

            return redirect()->to(base_url('dashboard'));
        } else {
            $this->session->setFlashdata('error', ['Username/Password Salah']);
            return redirect()->to(base_url('list'));
        }
    }


    public function update_user()
    {
        $dashboardmodel = new DashboardModel;

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $nomor = $this->request->getPost('nomor');

        $data = [
            'username' => $username,
            'nomor' => $nomor,
        ];

        if (!empty($password)) {
            // Jika password diisi, tambahkan ke data yang akan diupdate
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        } else if (!empty($username)) {
            $data['username'] = $username;
        } else if (!empty($nomor)) {
            $data['nomor'] = $nomor;
        }


        $save = $dashboardmodel->updateuser($data);

        if ($save) {
            $this->session->remove('status');
            $this->session->setFlashdata('success', ['User berhasil diubah!']);
            return redirect()->to(base_url('/'));
        } else {
            $this->session->setFlashdata('error', ['Gagal!']);
            return redirect()->to(base_url('router/list'));
        }
    }


    public function dashboard()
    {

        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
            $interface = $row->traffic_interface;
        }

        if ($this->ros->connect($host, $uname, $pass)) {
            // get hotspot info

            $hotspotuser = $this->ros->comm("/ip/hotspot/user/print");
            $hotspotactive = $this->ros->comm("/ip/hotspot/active/print");
            $hotspotprofile = $this->ros->comm("/ip/hotspot/user/profile/print");

            //get mikrotik system clock
            $getclock = $this->ros->comm("/system/clock/print");
            $clock = $getclock[0];
            $timezone = $getclock[0]['time-zone-name'];

            // get MikroTik system clock
            $getresource = $this->ros->comm("/system/resource/print");

            $resource = $getresource[0];

            // get routeboard info
            $getrouterboard = $this->ros->comm("/system/routerboard/print");

            $routerboard = $getrouterboard[0];

            //get interface
            $getinterface = $this->ros->comm("/interface/print");

            //get intraface db
            $monitor = $interface;

            $data = [
                'title' => 'Dashboard',
                'hotspotuser' => count($hotspotuser),
                'hotspotactive' => count($hotspotactive),
                'hotspotprofile' => count($hotspotprofile),
                'sysdate' => $clock['date'],
                'systime' => $clock['time'],
                'uptime' => $resource['uptime'],
                'timezone' => $timezone,
                'model' => $routerboard['model'],
                'architecture' => $resource['architecture-name'],
                'version' => $resource['version'],
                'interface' => $getinterface,
                'traffics' => $monitor,
                'month' => $dashboardmodel->month(),
                'vcrmonth' => $dashboardmodel->vcrmonth(),
                'today' => $dashboardmodel->today(),
                'vcrtoday' => $dashboardmodel->vcrtoday(),
                'yesterday' => $dashboardmodel->yesterday(),
                'vcrystrdy' => $dashboardmodel->vcrystrdy(),
                'view' => 'base/dashboard/home',

            ];

            return view('base/templates/layout', $data);
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function traffic()
    {
        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
            $interfaces = $row->traffic_interface;
        }

        if ($this->ros->connect($host, $uname, $pass)) {
            $getinterface = $this->ros->comm("/interface/monitor-traffic", array(
                'interface' => $interfaces,
                'once' => '',
            ));
            $rows = array();
            $rows2 = array();


            $ftx = $getinterface[0]['rx-bits-per-second'];
            $frx = $getinterface[0]['tx-bits-per-second'];

            $rows['name'] = 'Tx';
            $rows['data'][] = $ftx;
            $rows2['name'] = 'Rx';
            $rows2['data'][] = $frx;
            $result = array();

            array_push($result, $rows);
            array_push($result, $rows2);
            print json_encode($result);
        }
    }

    public function adduser()
    {
        $dashboardmodel = new DashboardModel;

        $getprofile = $dashboardmodel->getservice();


        if ($getprofile == null) {
            $this->session->setFlashdata('error', ['Belum ada database profile, silahkan tambah profile atau sinkronisasi terlebih dahulu']);

            return redirect()->to(base_url('hotspot/profile'));
        } else {
            $router = $dashboardmodel->get_router();
            foreach ($router as $row) {
                $host = $row->ip;
                $uname = $row->username;
                $pass = decrypt($row->password);
            }

            if ($this->ros->connect($host, $uname, $pass)) {
                $serverhotspot = $this->ros->comm("/ip/hotspot/print");

                $data = [
                    'title' => 'Add User',
                    'server' => $serverhotspot,
                    'profile' => $getprofile,
                    'view' => 'base/router/hotspot/adduser'
                ];

                return view('base/templates/layout', $data);
            } else {
                $this->session->setFlashdata('error', ['Router tidak merespon']);
                return redirect()->to(base_url('router/list'));
            }
        }
    }

    public function prosesadduser()
    {
        $date = Time::now('Asia/Jakarta');
        $dashboardmodel = new DashboardModel;

        $code = $this->request->getPost('code');
        $profile = $this->request->getPost('profile');


        if (empty($code) || empty($profile)) {
            $this->session->setFlashdata('error', ['Gagal membuat user']);
            return redirect()->to(base_url('hotspot/adduser'));
        } else {

            $router = $dashboardmodel->get_router();

            foreach ($router as $row) {
                $host = $row->ip;
                $uname = $row->username;
                $pass = decrypt($row->password);
            }

            if ($this->ros->connect($host, $uname, $pass)) {

                $server = $this->request->getPost('server');
                $timelimit = $this->request->getPost('timelimit');

                $getprofile = $this->ros->comm("/ip/hotspot/user/profile/print", array(
                    "?name" => $profile,
                ));

                if ($getprofile == null) {
                    $dashboardmodel->delete_profile($profile);
                    $this->session->setFlashdata('error', ['Profile tidak ditemukan pada mikrotik dan berhasil di hapus pada database']);
                    return redirect()->to(base_url('hotspot/profile'));
                } else {
                    $oid = random_number(3) . random_number(4);

                    $checkprofile = $dashboardmodel->whereservice($profile);

                    foreach ($checkprofile as $dataprofile) {
                        $name = $dataprofile->service;
                        $price = $dataprofile->price;
                    }


                    if ($timelimit == "") {
                        $time = "0";
                    } else {
                        $time = $timelimit;
                    }

                    $this->ros->comm("/ip/hotspot/user/add", array(
                        'server' => $server,
                        'name' => $code,
                        'password' => $code,
                        'profile' => $profile,
                        'limit-uptime' => $time,
                    ));

                    $data = array(
                        'oid' => $oid,
                        'service' => $name,
                        'code' => $code,
                        'price' => $price,
                        'status' => '0',
                        'datetime' => $date,
                    );

                    $dashboardmodel->insertvoucher($data);
                    $this->session->setFlashdata('success', ['Berhasil membuat user baru']);
                    return redirect()->to(base_url('hotspot/users'));
                }
            } else {
                $this->session->setFlashdata('error', ['Router tidak merespon']);
                return redirect()->to(base_url('router/list'));
            }
        }
    }

    public function profile()
    {
        $dashboardmodel = new DashboardModel;

        $getprofile = $dashboardmodel->getservice();

        $countprofile = count($getprofile);


        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        if ($this->ros->connect($host, $uname, $pass)) {
            $getprofilem = $this->ros->comm("/ip/hotspot/user/profile/print");


            $data = [
                'title' => 'Hotspot Profile',
                'totalprofile' => $countprofile,
                'getprofile' => $getprofile,
                'getprofilm' => $getprofilem,
                'view' => 'base/router/hotspot/profile'
            ];

            return view('base/templates/layout', $data);
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function prosessinkron()
    {
        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();

        $name = $this->request->getPost('name');
        $uptime = $this->request->getPost('uptime');
        $price = $this->request->getPost('price');
        $mac = $this->request->getPost('mac');
        $shared = $this->request->getPost('shared');

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        if ($mac == 'Ya') {
            $lock = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        } else {
            $lock = '';
        }

        if ($this->ros->connect($host, $uname, $pass)) {

            $getprofile = $this->ros->comm("/ip/hotspot/user/profile/print", array(
                "?name" => $name,
            ));

            foreach ($getprofile as $data) {
                $id = $data['.id'];
                $ratelimit = $data['rate-limit'];
            }
            $scheduler = '{:local usernya $user;:if ([/system schedule find name=$usernya]="") do={/system schedule add name=$usernya interval=' . $uptime . ' on-event="/ip hotspot user remove [find name=$usernya]\r\n/ip hotspot active remove [find user=$usernya]\r\n/system schedule remove [find name=$usernya]"}}' . $lock;

            $updt = array(
                '.id' => $id,
                'shared-users' => $shared,
                "on-login" =>  $scheduler,
                "status-autorefresh" => "1m",
            );

            $this->ros->comm("/ip/hotspot/user/profile/set", $updt);

            $update = array(
                'service' => $name,
                'shared' => $shared,
                'ratelimit' => $ratelimit,
                'uptime' => $uptime,
                'price' => $price
            );

            $save = $dashboardmodel->insertservice($update);

            if ($save) {
                $this->session->setFlashdata('success', ['Profile berhasil disinkronkan']);
                return redirect()->to(base_url('hotspot/profile'));
            } else {
                $this->session->setFlashdata('error', ['Profile gagal disinkronkan']);
                return redirect()->to(base_url('hotspot/profile'));
            }
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function add_profile()
    {
        $dashboardmodel = new DashboardModel;

        $name = $this->request->getPost('name');
        $ratelimit = $this->request->getPost('ratelimit');
        $uptime = $this->request->getPost('uptime');
        $price = $this->request->getPost('price');
        $mac = $this->request->getPost('mac');
        $shared = $this->request->getPost('shared');

        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        if ($mac == 'Ya') {
            $lock = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        } else {
            $lock = '';
        }

        $scheduler = '{:local usernya $user;:if ([/system schedule find name=$usernya]="") do={/system schedule add name=$usernya interval=' . $uptime . ' on-event="/ip hotspot user remove [find name=$usernya]\r\n/ip hotspot active remove [find user=$usernya]\r\n/system schedule remove [find name=$usernya]"}}' . $lock;

        if ($this->ros->connect($host, $uname, $pass)) {
            $this->ros->comm("/ip/hotspot/user/profile/add", array(
                "name" => $name,
                "rate-limit" => $ratelimit,
                "shared-users" => $shared,
                "on-login" =>  $scheduler,
                "status-autorefresh" => "1m",
            ));

            $data = array(
                'service' => $name,
                'shared' => $shared,
                'ratelimit' => $ratelimit,
                'uptime' => $uptime,
                'price' => $price,
            );

            $save = $dashboardmodel->insertservice($data);

            if ($save) {
                $this->session->setFlashdata('success', ['Profile berhasil ditambahkan']);
                return redirect()->to(base_url('hotspot/profile'));
            } else {
                $this->session->setFlashdata('error', ['Profile gagal ditambahkan']);
                return redirect()->to(base_url('hotspot/profile'));
            }
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function delete_profile($service)
    {
        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        if ($this->ros->connect($host, $uname, $pass)) {
            $getprofile = $this->ros->comm("/ip/hotspot/user/profile/print", array(
                "?name" => $service,
            ));
            if ($getprofile == null) {
                $dashboardmodel->delete_profile($service);
                $this->session->setFlashdata('error', ['Profile tidak ditemukan pada mikrotik dan berhasil di hapus pada database']);
                return redirect()->to(base_url('hotspot/profile'));
            } else {
                foreach ($getprofile as $data) {
                    $id = $data['.id'];
                }
                $this->ros->comm("/ip/hotspot/user/profile/remove", array(
                    ".id" =>  $id,
                ));

                $dashboardmodel->delete_profile($service);
                $this->session->setFlashdata('success', ['Profile berhasil dihapus']);
                return redirect()->to(base_url('hotspot/profile'));
            }
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function edit_profile($service)
    {
        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();


        $name = $this->request->getPost('name');
        $ratelimit = $this->request->getPost('ratelimit');
        $uptime = $this->request->getPost('uptime');
        $price = $this->request->getPost('price');
        $mac = $this->request->getPost('mac');
        $shared = $this->request->getPost('shared');

        if ($mac == 'Ya') {
            $lock = '; [:local mac $"mac-address"; /ip hotspot user set mac-address=$mac [find where name=$user]]';
        } else {
            $lock = '';
        }


        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }
        if ($this->ros->connect($host, $uname, $pass)) {
            $getprofile = $this->ros->comm("/ip/hotspot/user/profile/print", array(
                "?name" => $service,
            ));
            if ($getprofile == null) {
                $dashboardmodel->delete_profile($service);
                $this->session->setFlashdata('error', ['Profile tidak ditemukan pada mikrotik dan berhasil di hapus pada database']);
                return redirect()->to(base_url('hotspot/profile'));
            } else {
                foreach ($getprofile as $data) {
                    $id = $data['.id'];
                }

                $scheduler = '{:local usernya $user;:if ([/system schedule find name=$usernya]="") do={/system schedule add name=$usernya interval=' . $uptime . ' on-event="/ip hotspot user remove [find name=$usernya]\r\n/ip hotspot active remove [find user=$usernya]\r\n/system schedule remove [find name=$usernya]"}}' . $lock;

                $updt = array(
                    '.id' => $id,
                    'name' => $name,
                    'shared-users' => $shared,
                    'rate-limit' => $ratelimit,
                    "on-login" =>  $scheduler,
                    "status-autorefresh" => "1m",
                );

                $this->ros->comm("/ip/hotspot/user/profile/set", $updt);


                $update = array(
                    'service' => $name,
                    'shared' => $shared,
                    'ratelimit' => $ratelimit,
                    'uptime' => $uptime,
                    'price' => $price,
                );

                $dashboardmodel->update_profile($service, $update);

                $this->session->setFlashdata('success', ['Profile berhasil diganti']);
                return redirect()->to(base_url('hotspot/profile'));
            }
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }

    public function active()
    {
        $dashboardmodel = new DashboardModel;

        $router = $dashboardmodel->get_router();

        foreach ($router as $row) {
            $host = $row->ip;
            $uname = $row->username;
            $pass = decrypt($row->password);
        }

        if ($this->ros->connect($host, $uname, $pass)) {

            // get hotspot info
            $hotspotactive = $this->ros->comm("/ip/hotspot/active/print");

            $data = [
                'title' => 'Hotspot Active',
                'totalhotspotactive' => count($hotspotactive),
                'hotspotactive' => $hotspotactive,

                'view' => 'base/router/hotspot/active'
            ];

            return view('base/templates/layout', $data);
        } else {
            $this->session->setFlashdata('error', ['Router tidak merespon']);
            return redirect()->to(base_url('router/list'));
        }
    }


    public function generate()
    {
        $dashboardmodel = new DashboardModel;

        $profile = $dashboardmodel->getservice();

        if ($profile == null) {
            $this->session->setFlashdata('error', ['Belum ada database profile, silahkan tambah profile atau sinkronisasi terlebih dahulu']);

            return redirect()->to(base_url('hotspot/profile'));
        } else {
            $router = $dashboardmodel->get_router();

            foreach ($router as $row) {
                $host = $row->ip;
                $uname = $row->username;
                $pass = decrypt($row->password);
            }

            if ($this->ros->connect($host, $uname, $pass)) {

                $serverhotspot = $this->ros->comm("/ip/hotspot/print");

                $data = [
                    'title' => 'Generate Voucher',
                    'server' => $serverhotspot,
                    'profile' => $profile,
                    'view' => 'base/router/hotspot/generate'
                ];

                return view('base/templates/layout', $data);
            }
        }
    }

    public function prosesgenerate()
    {
        ini_set('max_execution_time', 300);

        $date = Time::now('Asia/Jakarta');

        $dashboardmodel = new DashboardModel;

        $quantity = $this->request->getPost('quantity');
        if (isset($quantity)) {
            $router = $dashboardmodel->get_router();

            foreach ($router as $row) {
                $host = $row->ip;
                $uname = $row->username;
                $pass = decrypt($row->password);
            }

            if ($this->ros->connect($host, $uname, $pass)) {

                $server = $this->request->getPost('server');
                $lenght = $this->request->getPost('lenght');
                $character = $this->request->getPost('character');
                $profile = $this->request->getPost('profile');
                $timelimit = $this->request->getPost('timelimit');
                $comment = $this->request->getPost('comment');

                $cmnt = "vc-" . rand(100, 999)  . "-" .  date("d-m-y") . "-" . $comment;


                $checkprofile = $dashboardmodel->whereservice($profile);

                foreach ($checkprofile as $dataprofile) {
                    $name = $dataprofile->service;
                    $price = $dataprofile->price;
                }

                if ($timelimit == "") {
                    $time = "0";
                } else {
                    $time = $timelimit;
                }

                for ($n = 1; $n <= $quantity; $n++) {
                    $oid = random_number(3) . random_number(4);

                    if ($character == 'lower1') {
                        $voc[$n] = randLC($lenght);
                    } else if ($character == 'upper1') {
                        $voc[$n] = randUC($lenght);
                    } else if ($character == 'upplow1') {
                        $voc[$n] = randULC($lenght);
                    } else if ($character == 'mix') {
                        $voc[$n] = randNLC($lenght);
                    } else if ($character == 'mix1') {
                        $voc[$n] = randNUC($lenght);
                    } else if ($character == 'mix2') {
                        $voc[$n] = randNULC($lenght);
                    }
                }


                for ($n = 1; $n <= $quantity; $n++) {

                    $this->ros->comm("/ip/hotspot/user/add", array(
                        'server' => $server,
                        'name' => $voc[$n],
                        'password' => $voc[$n],
                        'profile' => $profile,
                        'limit-uptime' => $time,
                        'comment' => $cmnt
                    ));

                    $data = array(
                        'oid' => $oid,
                        'service' => $name,
                        'code' => $voc[$n],
                        'price' => $price,
                        'status' => '0',
                        'datetime' => $date,
                        'comment' => $cmnt
                    );

                    $save = $dashboardmodel->insertvoucher($data);
                }
                $this->session->setFlashdata('success', ['Berhasil generate voucher']);
                return redirect()->to(base_url('hotspot/generate'));
            } else {
                $this->session->setFlashdata('error', ['Router tidak merespon']);
                return redirect()->to(base_url('router/list'));
            }
        } else {
            $this->session->setFlashdata('error', ['Generate Voucher gagal']);
            return redirect()->to(base_url('hotspot/generate'));
        }
    }

    public function print_default($comment = null)
    {
        $dashboardmodel = new DashboardModel;

        if ($comment == null) {
            return redirect()->to(base_url('hotspot/users'));
        } else {
            $checkserv = $dashboardmodel->wherecomment($comment);

            if (count($checkserv) == 0) {
                return redirect()->to(base_url('hotspot/users'));
            } else {
                foreach ($checkserv as $dataserv) {
                    $service = $dataserv->service;
                }

                $checkservice = $dashboardmodel->whereservice($service);
                $router = $dashboardmodel->get_router();

                $data = [
                    'title' => 'Print Voucher ' . $comment,
                    'comment' => $checkserv,
                    'service' => $checkservice,
                    'router' => $router,
                ];

                return view('base/router/hotspot/print/default', $data);
            }
        }
    }

    public function print_small($comment = null)
    {
        $dashboardmodel = new DashboardModel;

        if ($comment == null) {
            return redirect()->to(base_url('hotspot/users'));
        } else {
            $checkserv = $dashboardmodel->wherecomment($comment);
            if (count($checkserv) == 0) {
                return redirect()->to(base_url('hotspot/users'));
            } else {
                foreach ($checkserv as $dataserv) {
                    $service = $dataserv->service;
                }

                $checkservice = $dashboardmodel->whereservice($service);
                $router = $dashboardmodel->get_router();

                $data = [
                    'title' => 'Print Voucher ' . $comment,
                    'comment' => $checkserv,
                    'service' => $checkservice,
                    'router' => $router,
                ];

                return view('base/router/hotspot/print/small', $data);
            }
        }
    }

    public function cekdatabycomment($comment = null)
    {
        $dashboardmodel = new DashboardModel;

        if ($comment == null) {
            return redirect()->to(base_url('hotspot/users'));
        } else {
            $check = $dashboardmodel->wherecomment($comment);

            if (count($check) == 0) {
                $this->session->setFlashdata('error', ['Tidak ada data comment tersebut']);

                return redirect()->to(base_url('hotspot/users'));
            } else {
                $data = [
                    'title' => 'Cek Voucher ' . $comment,
                    'totalhotspotuser' => count($check),
                    'comment' => $check,
                    'view' => 'base/router/hotspot/cekdatabycomment'
                ];

                return view('base/templates/layout', $data);
            }
        }
    }

    public function deletevoucherbycomment($comment = null)
    {
        $dashboardmodel = new DashboardModel;

        if ($comment == null) {
            return redirect()->to(base_url('hotspot/users'));
        } else {

            $data = $dashboardmodel->wherecomment($comment);
            $total = count($data);

            $router = $dashboardmodel->get_router();

            foreach ($router as $row) {
                $host = $row->ip;
                $uname = $row->username;
                $pass = decrypt($row->password);
            }

            if ($this->ros->connect($host, $uname, $pass)) {

                $getuser = $this->ros->comm("/ip/hotspot/user/print", array(
                    "?comment" => "$comment",
                    "?uptime" => "00:00:00",
                ));

                for ($i = 0; $i < $total; $i++) {
                    $usersdetails = $getuser[$i];
                    $uid = $usersdetails['.id'];

                    $this->ros->comm("/ip/hotspot/user/remove", array(
                        ".id" => "$uid",
                    ));
                }

                $dashboardmodel->deletevoucher($comment);
                $this->session->setFlashdata('success', ['Berhasil menghapus data voucher']);
                return redirect()->to(base_url('hotspot/users'));
            } else {
                $this->session->setFlashdata('error', ['Router tidak merespon']);
                return redirect()->to(base_url('router/list'));
            }
        }
    }


    public function users()
    {
        $dashboardmodel = new DashboardModel;

        $data = [
            'title' => 'Hotspot Users',
            'hotspotuser' => $dashboardmodel->hotspotuser(),
            'comment' => $dashboardmodel->comment(),

            'view' => 'base/router/hotspot/users'
        ];

        return view('base/templates/layout', $data);
    }

    public function report()
    {
        $dashboardmodel = new DashboardModel;

        $data = [
            'title' => 'Report Finance',
            'voucher' => $dashboardmodel->datavcrmonth(),
            'tahun' => $dashboardmodel->gettahunmasuk(),
            'credit' => $dashboardmodel->credit(),
            'credityears' => $dashboardmodel->credityears(),
            'hotspotuser' => $dashboardmodel->hotspotuser(),
            'comment' => $dashboardmodel->comment(),

            'view' => 'base/report/home'
        ];

        return view('base/templates/layout', $data);
    }

    public function report_filter()
    {
        $dashboardmodel = new DashboardModel;

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        if (empty($bulan) || empty($tahun)) {
            return redirect()->to(base_url('report'));
        } else {
            if ($bulan ==  '1') {
                $sebut = 'Januari';
            } else if ($bulan == '2') {
                $sebut = 'Februari';
            } else if ($bulan == '3') {
                $sebut = 'Maret';
            } else if ($bulan == '4') {
                $sebut = 'April';
            } else if ($bulan == '5') {
                $sebut = 'Mei';
            } else if ($bulan == '6') {
                $sebut = 'Juni';
            } else if ($bulan == '7') {
                $sebut = 'Juli';
            } else if ($bulan == '8') {
                $sebut = 'Agustus';
            } else if ($bulan == '9') {
                $sebut = 'September';
            } else if ($bulan == '10') {
                $sebut = 'Oktober';
            } else if ($bulan == '11') {
                $sebut = 'November';
            } else if ($bulan == '12') {
                $sebut = 'Desember';
            }

            $data = [
                'title' => 'Report Finance',
                'subtitle' => $sebut,
                'tahun' => $tahun,
                'datafilter' => $dashboardmodel->filter($bulan, $tahun),
                'credit' => $dashboardmodel->creditfilter($bulan, $tahun),
                'view' => 'base/report/filter'
            ];
            if (is_array($data['datafilter'])) {
                $row_count = count($data['datafilter']);
            } else {
                $row_count = $data['datafilter']->getNumRows();
            }

            if ($row_count == 0) {
                $this->session->setFlashdata('error', ['Tidak ada data di bulan tersebut']);
                return redirect()->to(base_url('report'));
            } else {
                return view('base/templates/layout', $data);
            }
        }
    }


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
}
