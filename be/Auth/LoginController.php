<?php

namespace Be\Auth;

use Libs\Database\DB;
use Libs\Web\Response;
use Libs\Web\Session;

class LoginController {

    public function index()
    {
        $users = DB::table('users')->select(['name'])->where('name', 'Kasir')->get();
        return $users;
    }

    public function login()
    {
        $data = $_POST;

        $user = DB::table('users')->where('username', $data['username'])->where('password', $data['password'])->first();

        if($user)
        {
            Session::set(['user_id'=>$user['id']]);
            return Response::json([], 'success');
        }

        return Response::json([], 'failed', 400);
    }

    public function logout()
    {
        Session::destroy();
        header('location: /login');
        die;
    }
}