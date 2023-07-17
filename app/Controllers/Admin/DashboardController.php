<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        $this->data['pageTitle'] ='Dashboard Pages';
        $this->data['currentAdminMenu'] = 'dashboard';
        $this->data['currentAdminSubMenu'] = 'dashboard';
        return view('admin/dashboard/index', $this->data);
    }
}
