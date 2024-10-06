<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChatQuestion extends Model
{
    use HasFactory;

    protected $chat = "chat_question";
    public function getChatQuestion(){
        $result = DB:: table($this->chat)->pluck('question');
        return $result;
    }
}
