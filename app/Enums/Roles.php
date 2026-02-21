<?php

namespace App\Enums;

enum Roles: string
{
    case Admin = 'Admin';
    case Manager = 'Manager';
    case Employee = 'Employee';
}
