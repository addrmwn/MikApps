<?php

namespace App\Models\base;

use CodeIgniter\Model;

class DashboardModel extends Model
{
    public function __construct()
    {

        parent::__construct();
        $db  = \Config\Database::connect();
        $this->users = $db->table('users');
        $this->report = $db->table('report');
        $this->voucher = $db->table('voucher');
        $this->service =  $db->table('services');
        $this->router = $db->table('router');
        $this->session = session();
    }

    public function getuser($where)
    {
        $builder = $this->users;
        $query = $builder->getWhere(['username' => $where]);
        return $query;
    }

    public function get_router()
    {
        $builder = $this->router;
        $query = $builder->get();
        return $query->getResult();
    }

    public function hotspotuser()
    {
        $builder = $this->voucher;
        $builder->orderBy('id', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function comment()
    {
        $builder = $this->voucher;
        $builder->groupBy('comment', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function wherecomment($comment)
    {
        $builder = $this->voucher;
        $builder->where('comment', $comment);
        $query = $builder->get();
        return $query->getResult();
    }



    public function getservice()
    {
        $builder = $this->service;
        $query = $builder->get();
        return $query->getResult();
    }

    public function whereservice($id)
    {
        $builder = $this->service;
        $builder->where('service', $id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertservice($save)
    {
        $builder = $this->service;
        return $builder->insert($save);
    }

    public function insertvoucher($save)
    {
        $builder = $this->voucher;
        return $builder->insert($save);
    }

    public function insertreport($save)
    {
        $builder = $this->report;
        return $builder->insert($save);
    }


    public function auth_router($data)
    {
        $builder = $this->router;
        $builder->where($data);
        $query = $builder->get();
        return $query->getResult();
    }


    public function do_add_router($saverouter)
    {
        $builder = $this->router;
        return $builder->insert($saverouter);
    }


    public function updateuser($data)
    {
        $builder = $this->users;
        $builder->where('id', $_SESSION['id']);
        return $builder->update($data);
    }

    public function edit_router($data, $router_id)
    {
        $builder = $this->router;
        $builder->where('id', $router_id);
        return $builder->update($data);
    }

    public function delete_router($router_id)
    {
        $builder = $this->router;
        $builder->where('id', $router_id);
        return $builder->delete();
    }

    public function delete_profile($name)
    {
        $builder = $this->service;
        $builder->where('service', $name);
        return $builder->delete();
    }

    public function deletevoucher($data)
    {
        $builder = $this->voucher;
        $builder->where('comment', $data);
        return $builder->delete();
    }

    public function deletevouchersingle($data)
    {
        $builder = $this->voucher;
        $builder->where('code', $data);
        return $builder->delete();
    }

    public function statusvoucher()
    {
        $builder = $this->voucher;
        $builder->where('status', '0');
        $query = $builder->get();
        return $query->getResult();
    }

    public function voucherall()
    {
        $builder = $this->voucher;
        $query = $builder->get();
        return $query->getResult();
    }

    public function update_profile($name, $data)
    {
        $builder = $this->service;
        $builder->where('service', $name);
        return $builder->update($data);
    }

    public function datavcrmonth()
    {
        $builder = $this->report;
        $builder->where('MONTH(report.date)', date('m'));
        $builder->where('YEAR(report.date)', date('Y'));
        $query = $builder->get();
        return $query->getResult();
    }

    public function gettahunmasuk()
    {
        $builder = $this->report;
        $builder->select('YEAR(date) AS tahun');
        $builder->groupBy('YEAR(date)');
        $builder->orderBy('YEAR(date)', 'ASC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function credit()
    {
        $builder = $this->report;
        $builder->selectSum('price', 'total');
        $builder->where('MONTH(report.date)', date('m'));
        $builder->where('YEAR(report.date)', date('Y'));
        $query = $builder->get();
        $row = $query->getRow();
        return $row->total;
    }

    public function filter($bulan, $tahun)
    {
        $builder = $this->report;

        $query = $builder
            ->where('MONTH(date)', $bulan)
            ->where('YEAR(date)', $tahun)
            ->orderBy('date', 'ASC')
            ->get();

        return $query->getResult();
    }

    public function creditfilter($bulan, $tahun)
    {
        $builder = $this->report;

        $query = $builder
            ->selectSum('price', 'total')
            ->where('MONTH(date)', $bulan)
            ->where('YEAR(date)', $tahun)
            ->get();

        return $query->getRow()->total;
    }

    public function vcrmonth()
    {
        $builder = $this->report;

        $query = $builder
            ->select('*')
            ->where('MONTH(report.date)', date('m'))
            ->where('YEAR(report.date)', date('Y'))
            ->get();

        return $query->getNumRows();
    }

    public function today()
    {
        $builder = $this->report;

        $query = $builder
            ->selectSum('price', 'total')
            ->where('DATE(date)', date('Y-m-d'))
            ->get();

        $result = $query->getRow();

        return $result->total;
    }

    public function vcrtoday()
    {
        $builder = $this->report;

        $query = $builder
            ->where('DATE(date)', date('Y-m-d'))
            ->get();

        return $query->getNumRows();
    }

    public function yesterday()
    {
        $builder = $this->report;

        $query = $builder
            ->selectSum('price', 'total')
            ->where('DATE(date)', date('Y-m-d', strtotime('-1 day')))
            ->get();

        $result = $query->getRow();

        return $result->total;
    }

    public function vcrystrdy()
    {
        $builder = $this->report;

        $query = $builder
            ->where('DATE(date)', date('Y-m-d', strtotime('-1 day')))
            ->get();

        return $query->getNumRows();
    }

    public function month()
    {
        $builder = $this->report;

        $query = $builder
            ->selectSum('price', 'total')
            ->where('MONTH(report.date)', date('m'))
            ->where('YEAR(report.date)', date('Y'))
            ->get();

        $result = $query->getRow();

        return $result->total;
    }
}
