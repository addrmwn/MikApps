<?php


namespace App\Controllers\base;

use App\Controllers\BaseController;
use App\Models\base\DashboardModel;
use App\Libraries\RouterosAPI;

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


        if (empty($password)) {
            $this->session->setFlashdata('error', ['Password belum di isi']);
            return redirect()->to(base_url('router/list'));
        } else {
            $data = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT),
            ];

            $save = $dashboardmodel->updateuser($data);

            if ($save) {
                $this->session->setFlashdata('success', ['User berhasil diubah!']);
                return redirect()->to(base_url('router/list'));
            } else {
                $this->session->setFlashdata('error', ['Gagal!']);
                return redirect()->to(base_url('router/list'));
            }
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


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url('/'));
    }
}
