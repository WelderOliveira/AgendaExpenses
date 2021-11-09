<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'cep','logradouro','complemento','bairro','localidade','uf'
    ];
    use HasFactory;

    public function contato()
    {
        return $this->belongsTo('App\Models\Contato');
    }
}
