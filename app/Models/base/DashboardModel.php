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
}
