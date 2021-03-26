<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\PessoaFisica;
use App\Models\PessoaJuridica;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['pessoa', 'enderecos'])->get();
        return $users;
    }
    
    public function create()
    {
        return view('users.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();
        $person = null;
        if($data['tipo'] == 'pessoaFisica'){
            $this->validate($request, [
                'name'=>'sometimes|required',
                'cpf' => 'sometimes|cpf|unique:pessoas_fisicas,cpf',
                'email'=>'required|email|unique:users,email',
                'password'=>'min:6'
                
            ], [
                'name.required' => 'Preencha um nome',
                'cpf.cpf' => 'CPF invalido',
                'cpf.unique' => 'CPF já foi registrado',
                'password.min' => 'Senha menos que 6 digitos',
                'email.unique'=>'Email já registrado'
            ]);    
            $person = new PessoaFisica();
            $person->sobrenome = $data['sobrenome'];
            $person->cpf = $data['cpf'];
            $person->rg = $data['rg'];
            $person->data_nascimento = $data['data_nascimento'];
            $person->sexo = $data['sexo'];
        }
        else{
            $this->validate($request, [
                'name_pj'=>'sometimes|required',
                'cnpj' => 'sometimes|cnpj|unique:pessoas_juridicas,cnpj',
                'email'=>'required|email|unique:users,email',
                'password'=>'min:6'
                
            ], [
                'name.required' => 'Preencha um nome',
                'cnpj.cnpj' => 'CNPJ invalido',
                'CNPJ.unique' => 'CNPJ já foi registrado',
                'password.min' => 'Senha menos que 6 digitos',
                'email.unique'=>'Email já registrado'
            ]);
            $person = new PessoaJuridica();
            $person->razao_social = $data['razao_social'];
            $person->cnpj = $data['cnpj'];
        }

        $person->save();
        
        $user = new User();
        $user->name = $data['tipo'] == 'pessoaFisica' ? $data['name'] : $data['name_pj'];
        $user->cellphone = $data['cellphone'];
        $user->landline = $data['landline'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->pessoa()->associate($person);
        $user->save();

        $endereco = new Endereco();
        $endereco->logradouro = $data['rua'];
        $endereco->numero = $data['numero'];
        $endereco->complemento = $data['complemento'];
        $endereco->bairro = $data['bairro'];
        $endereco->cidade = $data['cidade'];
        $endereco->uf = $data['uf'];
        $user->enderecos()->save($endereco);
        
        
        return redirect('/')->with('status', 'Cadastro realizado com sucesso!');
    }

    
}
