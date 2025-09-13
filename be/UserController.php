<?php

namespace Be;

use Libs\Database\DB;
use Libs\Web\Response;

class UserController {
    
    function store()
    {
        DB::table('users')->insert($_POST);

        return Response::json([], 'insert data success');
    }
    
    function update()
    {
        $id = $_GET['id'];
        DB::table('users')->where('id', $id)->update($_POST);

        return Response::json([], 'update data success');
    }
    
    function delete()
    {
        $id = $_GET['id'];
        DB::table('users')->where('id', $id)->delete();

        return Response::json([], 'delete data success');
    }

    function show()
    {
        $id = $_GET['id'];
        $user = DB::table('users')->where('id', $id)->first();

        return Response::json($user, 'data retrieved');
    }
}