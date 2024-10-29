<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;

class SearchHistory extends Model
{
    use Searchable;

    protected $table ="search_history" ;
    protected $primaryKey = 'id_ls';
    public function toSearchableArray()
    {
         return [
             'id_ls' => $this->id_ls,
             'id_lp' => $this->id_lp,
            
         ];
    }
}