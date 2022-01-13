<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class AdminController extends Controller
{
    
    public function dashboard(){
        $users = User::whereIn('role' , [User::Roles['User'] , User::Roles['Staff']])->get();
        return Inertia::render('AdminDashboard' , ['users' => $users]);
    }

    public function makeActive($id){
        $user = User::find($id);
        $user->status = 1;
        $user->update();
        return back()->withSuccess("done");
    }
    public function makeInactive($id){
        $user = User::find($id);
        $user->status = 0;
        $user->update();
        return back()->withSuccess("done");
    }
    public function makeUser($id){
        $user = User::find($id);
        $user->role = User::Roles['User'];
        $user->update();
        return back()->withSuccess("done");
    }
    public function makeStaff($id){
        $user = User::find($id);
        $user->role = User::Roles['Staff'];
        $user->update();
        return back()->withSuccess("done");
    }



}
