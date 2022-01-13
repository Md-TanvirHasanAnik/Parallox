<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class StaffController extends Controller
{
    //
    public function dashboard(){
        $users = User::whereIn('role' , [User::Roles['User']])->get();
        return Inertia::render('StaffDashboard' , ['users' => $users]);
    }
}
