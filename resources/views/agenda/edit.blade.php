@extends('layouts.app')
@section('js')

    <script src="{{ asset('js/edit.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
@endsection

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1>Editar Contato</h1>
        <form action="{{ route('editContato',$contato->id) }}" method="POST" name="form" id="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="{{$contato->nome}}">
            </div>
            <input type="hidden" class="id" value="{{$contato->id}}">

            <div class="form-group">
                <div class="col-md-2 col-sm-12">
                    <input type="hidden" id="indexTelAdicional" value="1" class="form-control ">
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-10" id="TelsAdicionais">
                    <input type="hidden" id="indexTel-1" value="1" class="form-control TelsAdicionais">
                    <label id="labelTelAdicional-1">Telefone</label>
                    <input type="text" name="TelAdicional-1" id="TelAdicional-1" value="@if($fones){{$fones[0]['numero']}}@endif" class="form-control telefone">
                </div>
                <div class="form-group col-md-2" id="acaoTelsAdicionais">
                    <div id="acaoTelAdicional-1">
                        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <button type="button" class="btn btn-primary" onclick="addTelAdicional()"><i
                                class="fa fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{$contato->email}}" class="form-control">
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" value="{{$contato->data_nascimento->format('Y-m-d')}}" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" id="avatar" name="avatar" class="form-control-file">
                <img src="img/contato/{{$contato->avatar}}" style="width: 40px;height: 40px;border: 1px solid #c0c0c0;border-radius: 5px;" alt="{{$contato->nome}}" class="img-preview my-2">
            </div>
            <div class="form-group">
                <label for="anotacoes"></label>
                <textarea name="anotacoes" id="anotacoes" cols="30" rows="10" class="form-control">{{$contato->anotacao}}</textarea>
            </div>
            {{--            PARTE DO ENDEREÇO --}}
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="cepLabel">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" value="{{$endereco['cep']}}" required>
                </div>
                <div class="form-group col-md-9">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" value="{{$endereco['bairro']}}" required>
                </div>
            </div>
            <div class="form-group">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro"
                       placeholder="Av Vinicius de Morais, 25" value="{{$endereco['logradouro']}}" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="localidade">Cidade</label>
                    <input type="text" class="form-control" id="localidade" name="localidade"
                           value="{{$endereco['localidade']}}"required>
                </div>

                <div class="form-group col-md-4">
                    <label for="uf">Estado</label>
                    <select id="uf" name="uf" class="form-control" required>
                        <option selected hidden>Escolha...</option>
                        <option value="AC"{{ $endereco['uf'] == "AC" ? 'selected' : '' }}>Acre</option>
                        <option value="AL"{{ $endereco['uf'] == "AL" ? 'selected' : '' }}>Alagoas</option>
                        <option value="AP"{{ $endereco['uf'] == "AP" ? 'selected' : '' }}>Amapá</option>
                        <option value="AM"{{ $endereco['uf'] == "AM" ? 'selected' : '' }}>Amazonas</option>
                        <option value="BA"{{ $endereco['uf'] == "BA" ? 'selected' : '' }}>Bahia</option>
                        <option value="CE"{{ $endereco['uf'] == "CE" ? 'selected' : '' }}>Ceará</option>
                        <option value="DF"{{ $endereco['uf'] == "DF" ? 'selected' : '' }}>Distrito Federal</option>
                        <option value="ES"{{ $endereco['uf'] == "ES" ? 'selected' : '' }}>Espírito Santo</option>
                        <option value="GO"{{ $endereco['uf'] == "GO" ? 'selected' : '' }}>Goiás</option>
                        <option value="MA"{{ $endereco['uf'] == "MA" ? 'selected' : '' }}>Maranhão</option>
                        <option value="MT"{{ $endereco['uf'] == "MT" ? 'selected' : '' }}>Mato Grosso</option>
                        <option value="MS"{{ $endereco['uf'] == "MS" ? 'selected' : '' }}>Mato Grosso do Sul</option>
                        <option value="MG"{{ $endereco['uf'] == "MG" ? 'selected' : '' }}>Minas Gerais</option>
                        <option value="PA"{{ $endereco['uf'] == "PA" ? 'selected' : '' }}>Pará</option>
                        <option value="PB"{{ $endereco['uf'] == "PB" ? 'selected' : '' }}>Paraíba</option>
                        <option value="PR"{{ $endereco['uf'] == "PR" ? 'selected' : '' }}>Paraná</option>
                        <option value="PE"{{ $endereco['uf'] == "PE" ? 'selected' : '' }}>Pernambuco</option>
                        <option value="PI"{{ $endereco['uf'] == "PI" ? 'selected' : '' }}>Piauí</option>
                        <option value="RJ"{{ $endereco['uf'] == "RJ" ? 'selected' : '' }}>Rio de Janeiro</option>
                        <option value="RN"{{ $endereco['uf'] == "RN" ? 'selected' : '' }}>Rio Grande do Norte</option>
                        <option value="RS"{{ $endereco['uf'] == "RS" ? 'selected' : '' }}>Rio Grande do Sul</option>
                        <option value="RO"{{ $endereco['uf'] == "RO" ? 'selected' : '' }}>Rondônia</option>
                        <option value="RR"{{ $endereco['uf'] == "RR" ? 'selected' : '' }}>Roraima</option>
                        <option value="SC"{{ $endereco['uf'] == "SC" ? 'selected' : '' }}>Santa Catarina</option>
                        <option value="SP"{{ $endereco['uf'] == "SP" ? 'selected' : '' }}>São Paulo</option>
                        <option value="SE"{{ $endereco['uf'] == "SE" ? 'selected' : '' }}>Sergipe</option>
                        <option value="TO"{{ $endereco['uf'] == "TO" ? 'selected' : '' }}>Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" value="{{$endereco['complemento']}}" name="complemento"
                       placeholder="Apartamento, casa, sítio...">
            </div>

            {{--            <input type="submit" class="btn btn-primary">--}}
            <div class="col-sm-6 ">
                <button class="btn btn-primary pull-right" onclick="save()" id="submit" name="submit" type="button"><i
                        class="fa fa-save"> </i> Salvar Novo Contato
                </button>
            </div>
        </form>
    </div>
@endsection

@section('javascript')
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
@endsection
