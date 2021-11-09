<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $fillable = [
        'numero'
    ];
    use HasFactory;

    public function contato()
    {
        return $this->belongsTo('App\Models\Contato');
    }
}
