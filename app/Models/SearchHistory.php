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
    protected $fillable = [
        'id_lp',
        'id_kh',
        'keywords'
    ];
    public function toSearchableArray()
    {
         return [
             'id_ls' => $this->id_ls,
             'id_lp' => $this->id_lp,      
         ];
    }

    public function getSearchRoom($id_kh){
        return $result = DB::table($this->table)
                            ->where('id_kh', $id_kh)
                            ->select('id_lp')
                            ->distinct()
                            ->whereBetween('created_at', [
                                now()->subDays(15)->startOfDay(),
                                now()->endOfDay()
                            ])
                            ->orderBy('created_at', 'desc')
                            ->limit(4)
                            ->get();
    }
}