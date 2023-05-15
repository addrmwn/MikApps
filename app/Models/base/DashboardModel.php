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

    public function update_profile($name, $data)
    {
        $builder = $this->service;
        $builder->where('service', $name);
        return $builder->update($data);
    }
}
