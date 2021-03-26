<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    protected $table = 'pessoas_fisicas';
    protected $fillable = ['sobrenome','cpf','rg','data_nascimento','sexo'];

    public function pessoaType(){
    	return $this->morphMany(User::class, 'pessoa');
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
