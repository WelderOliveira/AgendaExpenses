@extends('layouts.app')
@section('js')

    <script src="{{ asset('js/create.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.js') }}"></script>
@endsection

@section('content')
    <div class="col-md-6 offset-md-3">
        <h1>Crie o seu Contato</h1>
        <form action="{{ route('storeContatos') }}" method="POST" name="form" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control">
            </div>

            <div class="form-group">
                <div class="col-md-2 col-sm-12">
                    <input type="hidden" id="indexTelAdicional" value="1" class="form-control ">
                </div>
            </div>

            <div class="form-group row">
                <div class="form-group col-md-10" id="TelsAdicionais">
                    <input type="hidden" id="indexTel-1" value="1" class="form-control TelsAdicionais">
                    <label id="labelTelAdicional-1">Telefone</label>
                    <input type="text" name="TelAdicional-1" id="TelAdicional-1" class="form-control telefone">
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
                <input type="email" id="email" name="email" class="form-control">
            </div>

            <div class="form-group">
                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" id="data_nascimento" name="data_nascimento" class="form-control">
            </div>
            <div class="form-group">
                <input type="file" id="avatar" name="avatar" class="form-control-file">
            </div>
            <div class="form-group">
                <label for="anotacoes"></label>
                <textarea name="anotacoes" id="anotacoes" cols="30" rows="10" class="form-control"></textarea>
            </div>
            {{--            PARTE DO ENDEREÇO --}}
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="cepLabel">CEP</label>
                    <input type="text" class="form-control" id="cep" name="cep" required>
                </div>
                <div class="form-group col-md-9">
                    <label for="bairro">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro" required>
                </div>
            </div>
            <div class="form-group">
                <label for="logradouro">Logradouro</label>
                <input type="text" class="form-control" id="logradouro" name="logradouro"
                       placeholder="Av Vinicius de Morais, 25" required>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="localidade">Cidade</label>
                    <input type="text" class="form-control" id="localidade" name="localidade" required>
                </div>

                <div class="form-group col-md-4">
                    <label for="uf">Estado</label>
                    <select id="uf" name="uf" class="form-control" required>
                        <option selected hidden>Escolha...</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento"
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
