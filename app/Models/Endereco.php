<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = 'enderecos';
    protected $fillable = ['logradouro','numero','complemento','bairro','cidade','uf','user_id'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at','created_at'
    ];
}
