<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    protected $us="users"   ;
    public function checkLogin($email,$pass){
        $result = DB::table($this->us)
                                ->select('*')
                                ->where('email',$email)
                                ->where('password',$pass)
                                ->first();
            return $result;
    }
    

    public function insertAd($data){
        $result = DB::table($this->us)->insert([
            'ho_ten' => $data['ho_ten'],
            'gioi_tinh' => $data['gioi_tinh'],
            'sdt' => $data['sdt'],
            'email' => $data['email'],
            'dia_chi' => $data['dia_chi'],
            'password' => $data['pass'],
            'role' =>0,
        ]);
        return $result;
    }

    public function insertKH($data){
        $result = DB::table($this->us)->insert([
            'ho_ten' => $data['ho_ten'],
            'gioi_tinh' => $data['gioi_tinh'],
            'sdt' => $data['sdt'],
            'email' => $data['email'],
            'dia_chi' => $data['dia_chi'],
            'password' => $data['pass'],
            'role' =>1,
            'token'  => $data['token'],
        ]);
        return $result;
    }

    public function checkUser($email){
        $result =DB::table($this->us)
                    ->where('email',$email)
                    // ->where('status',1)
                    ->first();
                return $result;
    }

    public function checkLoginCtm($email,$pass){
        $result = DB::table($this->us)
                                ->select('*')
                                ->where('email',$email)
                                ->where('password',$pass)
                                ->first();
            return $result;
    }

    public function getUser($id){
        $result = DB::table($this->us)
                    ->where('id',$id)
                    ->first();
            return $result;
    }

    public function updateUS($email,$token){
        return $result = DB::table($this->us)
                            ->where('email', $email)
                            ->update(['token' => $token]);
    }

    public function updateUser($email, $data){
        return $result = DB::table($this->us)
                            ->where('email', $email)
                            ->update($data);
    }
    public function updatePass($email){
        return $result = DB::table($this->us)
                                ->where('email', $email)
                                ->update(['password' => NULL]);
    }

    public function getID($email){
        return $result = DB::table($this->us)
                            ->where('email', $email)
                            ->value('id');
    }
    
    public function insertUser($data){
        return $result = DB::table($this->us)
                            ->insert($data);
    }


}