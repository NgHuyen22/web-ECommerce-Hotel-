<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contact';
    public function insertCT($data){
        return $result = DB::table($this->table)
                            ->insert($data);
    }

    public function getContact() {
        return $result = DB::table($this->table)
                            ->where('status',1)
                            ->paginate(5);
                     
    }

    public function getContact2() {
        return $result = DB::table($this->table)
                            ->where('status',0)
                            ->paginate(5);
    }

    public function info($id_contact){
        return $result = DB::table($this->table)
                            ->where('id',$id_contact)
                            ->first();
    }

    public function updatedCT($id_contact) {
        return $result = DB::table($this->table)
                            ->where('id',$id_contact)
                            ->update(['status' => 0]);
    }
}
