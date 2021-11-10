<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = [
      'nome','email','data_nascimento','avatar','anotacao'
    ];

    use HasFactory;

    public function telefones()
    {
        return $this->hasMany('App\Models\Telefone');
    }

    public function enderecos()
    {
        return $this->hasMany('App\Models\Enderecos');
    }
}
