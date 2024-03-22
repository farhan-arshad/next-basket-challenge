<?php

namespace App\Http\Controllers;

use App\User;
use App\Jobs\UserCreate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserController extends Controller
{
    use DispatchesJobs;

    public function createUser(Request $request) {
        $user = new User();
        $user->fill($request->all());
        $user->name = $request->input('first_name') . ' ' . $request->input('last_name');
        $user->password = Hash::make(Str::random(40));
        $user->save();
        UserCreate::dispatch($user->toArray())->onConnection('rabbitmq');
        return response()->json(array(
            'data' => $user 
        ));
    }
}
