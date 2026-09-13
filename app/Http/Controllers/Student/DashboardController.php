<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\DashboardController as BaseDashboardController;

class DashboardController extends BaseDashboardController
{
    public function index()
    {
        return $this->student();
    }
}
