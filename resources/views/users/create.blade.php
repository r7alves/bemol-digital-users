@extends('app')
@section('content')
  
    <div class="container" >
        <div class="py-5 text-center">
            {{-- <img class="d-block mx-auto mb-4" src="https://d8xabijtzlaac.cloudfront.net/Custom/Content/Themes/Shared/Images/marca-bemol.svg" --}}
                {{-- alt="" width="120" height="120"> --}}
            <h2>Dados Cadastrais</h2>
            
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="row mb-2" >
            <div class="col-md-8  offset-md-2">
                <hr class="mb-4">
                <h4 class="mb-3">Dados Pessoais</h4>
                <form method="POST" class="needs-validation" novalidate="" action="{{ route('users.store') }}" >
                    <input type="radio" name="tipo" value="pessoaFisica" checked> Pessoa Física</input>
                    <input type="radio" name="tipo" value="pessoaJuridica"> Pessoa Jurídica</input>
                        {{ csrf_field() }}
                        
                    <div class="row" id="camposPJ">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nome</label>
                            <input type="text" class="form-control" id="firstNamePJ" name="name_pj"  
                                value="{{old('name_pj')}}" required >
                            <div class="invalid-feedback">
                                Preencha o nome.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="razao_social">Razão Social</label>
                            <input type="text" class="form-control" id="razao_social" placeholder="" name="razao_social" value="{{old('razao_social')}}" required>
                            <div class="invalid-feedback">
                                Preencha a razão social.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cnpj">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder="" value="{{old('cnpj')}}" required >
                            <div class="invalid-feedback">
                                Preencha o CNPJ.
                            </div>
                            @error('cnpj')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row" id="camposPF">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nome</label>
                            <input type="text" class="form-control" id="firstName" name="name"  
                                value="{{old('name')}}" required>
                            <div class="invalid-feedback">
                                Preencha o nome.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Sobrenome</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" name="sobrenome"
                                value="{{old('sobrenome')}}" required >
                            <div class="invalid-feedback">
                                Preencha o sobrenome.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"  
                                value="{{old('cpf')}}" required >
                            <div class="invalid-feedback">
                                Preencha o CPF.
                            </div>
                            @error('cpf')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rg">RG</label>
                            <input type="text" class="form-control" name="rg" id="rg" maxlength="10" placeholder="" 
                                value="{{old('rg')}}" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Data de Nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="" 
                                value="{{old('data_nascimento')}}" required="">
                            <div class="invalid-feedback">
                                Preencha a data de nascimento.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sexo">Sexo</label>
                            <select id="inputState" class="form-control" name="sexo" required value="{{old('sexo')}}">
                                <option value="">Selecione</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                                <option value="outro">Outro</option>
                                </select>
                            <div class="invalid-feedback">
                                Selecione o sexo.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Dados de contato</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cellphone">Telefone Celular</label>
                            <input type="text" class="form-control" id="cellphone" name="cellphone"  
                                value="{{old('cellphone')}}" required data-mask="(00) 0000-0000">
                            <div class="invalid-feedback">
                                Preencha o telefone celular.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="landline">Telefone fixo</label>
                            <input type="text" class="form-control" id="landline" name="landline"  
                                value="{{old('landline')}}" >
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Endereço</h4>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cep">Cep</label>
                            <input type="text" class="form-control" id="cep" value="{{old('cep')}}" size="10" maxlength="9" onblur="pesquisacep(this.value);" required name="cep">
                            <div class="invalid-feedback">
                               Informe o cep
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="rua">Logradouro</label>
                            <input name="rua" type="text" id="rua" size="60" class="form-control" required value="{{old('rua')}}" />
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="numero">Número </label>
                            <input name="numero" type="text" class="form-control" id="numero" placeholder="1234"
                                value="{{old('numero')}}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="complemento">Complemento </label>
                            <input name="complemento" type="text" class="form-control" id="complemento" placeholder="Residencia, comercial..."
                                value="{{old('complemento')}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="bairro">Bairro</label>
                            <input name="bairro" type="text" id="bairro" size="40"  class="form-control" 
                                value="{{old('bairro')}}" required/>
                        </div>
                        <div class="col-md-9 mb-3">
                            <label for="cidade">Cidade</label>
                            <input name="cidade" type="text" id="cidade" size="40"  class="form-control" 
                                value="{{old('cidade')}}" required/>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="estado">Estado</label>
                            <input name="uf" type="text" id="uf" size="2"  class="form-control"
                                value="{{old('uf')}}" required/>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h4 class="mb-3">Dados da Conta</h4>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">Email </label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="seu@email.com" 
                                value="{{old('email')}}" required>
                            <div class="invalid-feedback">
                                Informe o email para prosseguir
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Senha</label>
                            <input type="password" class="form-control" name="password"  id="password" placeholder="*******" required>
                            <div class="invalid-feedback">
                                Informe uma senha
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection