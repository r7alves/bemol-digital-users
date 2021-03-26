<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PessoaJuridica extends Model
{
    protected $table = 'pessoas_juridicas';
    protected $fillable = ['razao_social', 'cnpj'];

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
