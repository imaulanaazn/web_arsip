<?php

namespace App\Models;

use App\Enums\Config as ConfigEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LetterHead extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'content'];

    public function getById($id){
        return $this->where('id', $id);
    }
}
