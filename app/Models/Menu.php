<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $mn = 'menu';
    public function getMenuSV($id_dv){
        return $result = DB :: table($this -> mn)
                                -> where('status', 1)
                                -> where('dich_vu', $id_dv)
                                ->get();
    }
    public function getMenuFood($id_dv){
        return $result = DB :: table($this -> mn)
                                -> where('status', 1)
                                -> where('dich_vu', $id_dv)
                                ->first();
    }
}
