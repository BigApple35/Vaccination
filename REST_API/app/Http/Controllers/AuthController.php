<?php

namespace App\Http\Controllers;

use App\Models\Societies;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $societies;

    public function __construct(Societies $society){
        $this->societies = $society;
    }

    public function login(Request $request){
        $this->validate($request, [
            "id_card_number",
            "password"]
        );

        $data = $this->societies::with('region')->where("id_card_number", $request->id_card_number)->where('password', $request->password)->first();

        if($data){
            $data->update(['login_tokens' => md5($data->id_card_number)]);
            return Controller::success('Login Success', $data);
        }else{
            return Controller::error('Wrong Password or id');
        }
    }

    public function logout(Request $request){
        $society = $this->societies->where('id', $request->get('society_id'))->first();

        if($society){
            $society->update(['login_tokens' => null]);
            return Controller::success('', $society);
        }
    }
}
