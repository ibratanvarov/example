<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\InfoUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class UserController extends Controller
{
    public function index(){

//        $user = User::find(1);

//        $user->givePermissionTo("edit articles");

        return "hello";
//        $key = 1;
//
//        return Cache::remember(1, 3600, function () {
//           return User::with('info_user')->findOrFail(1);
//        });
    }

    public function update($id){
        $user = InfoUser::findOrFail($id);

//        $validated = [
//            'email' => "store@gmail.com",
//            'name' => "Ibrat11223344 Anvarov",
//            'password' => bcrypt(56789)
//        ];

        $user->update([
            'phone' => "2222222222222"
        ]);

        return $user;
    }

    public function nameUpdate($id){

        $user = User::findOrFail($id);

        $user->update([
            'name' => "Hayir"
        ]);

        return $user;
    }

    public function updateInfoUser($id){

        $infoUser = InfoUser::findOrFail($id);

        $infoUser->update([
            'phone' => "9988914352124"
        ]);

        return $infoUser;
    }
}
