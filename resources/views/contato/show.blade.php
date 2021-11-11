@extends('layouts.app')

@section('content')
    <div class="col-md-10 offset-md-1">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="/img/contatos/{{ $contato->avatar }}" alt="avatar"
                             class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="my-3">{{ $contato->nome }}</h5>
                        <p class="text-muted mb-1">{{$contato->anotacao}}</p>
                        <p class="text-muted mb-4">{{$endereco['localidade']}}, {{$endereco['uf']}}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <a href="{{route('editContato', $contato->id)}}" class="btn btn-outline-primary mx-2">
                                <i class="fas fa-user-edit"></i></a>
                            <a href="https://wa.me/@if($fones){{$fones[0]['numero']}}@else#@endif"
                               class="btn btn-outline-primary ms-1 mx-2">
                                <i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Nome</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $contato->nome }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $contato->email }}</p>
                            </div>
                        </div>
                        <hr>
                        @foreach($fones as $key => $fone)
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone { {{$key+1}} }</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">{{$fone['numero']}}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">CEP</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$endereco['cep']}}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Endereço</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{$endereco['bairro']}}, {{$endereco['localidade']}}, {{$endereco['uf']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
