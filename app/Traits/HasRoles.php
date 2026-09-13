<?php

namespace App\Traits;

trait HasRoles
{
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isStudent()
    {
        return $this->role === 'student';
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin' || $this->email === 'admin@mgtechs.com.ng';
    }
}