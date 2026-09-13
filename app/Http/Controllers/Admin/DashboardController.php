<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DashboardController as BaseDashboardController;

class DashboardController extends BaseDashboardController
{
    public function index()
    {
        return $this->admin();
    }
}
