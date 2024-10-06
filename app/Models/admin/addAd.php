<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class addAd extends Model
{
    use HasFactory;

    protected $users = 'users';
    public function insertAd($data){
         $result = DB::table($this->users)->insert([
            'ho_ten' => $data['ho_ten'],
            'gioi_tinh' => $data['gioi_tinh'],
            'sdt' => $data['sdt'],
            'email' => $data['email'],
            'dia_chi' => $data['dia_chi'],
            'password' => md5($data['password']),
            'role' =>  0,
            'created_at' =>now(),
            'updated_at' =>now(),
         ]);
         return $result;
    }
}
