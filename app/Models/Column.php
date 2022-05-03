<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    use HasFactory;

    public $fillable = ['title'];

    public function cards()
    {
        return $this->hasMany(Card::class, 'column_id');
    }
}
