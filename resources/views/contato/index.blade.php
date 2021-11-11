@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        Contatos
        <a href="{{ route('createContatos') }}" class="btn btn-primary btn-sm float-right">Novo</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive border-0">
            <table class="table table-hover" style="margin-bottom: inherit">
                <tbody>
                @foreach ($contatos as $contato)
                    <tr>
                        <td>
                            <a href="{{ url('contato/'.$contato->id) }}">
                                <img src="/img/contatos/{{ $contato->avatar }}" style="width: 30px;height: 30px;border: 1px solid #c0c0c0;border-radius: 5px;" class="img-avatar-xs">
                            </a>
                        </td>
                        <td><a class='a-line' href="{{ url('contato/'.$contato->id) }}">{{ $contato->nome }}</a></td>
                        <td class="d-none d-md-table-cell"><a class='a-line' href="{{ url('contatos/'.$contato->id) }}">{{ $contato->telefone }}</a></td>
                        <td class="d-none d-md-table-cell"><a class='a-line' href="{{ url('contatos/'.$contato->id) }}">{{ $contato->email }}</a></td>
                        <td class="d-none d-md-table-cell d-flex justify-content-center mb-2">
                            <a href="{{route('editContato', $contato->id)}}" class="btn btn-outline-primary mx-2">
                                <i class="fas fa-user-edit"></i></a>
                            <form action="{{route('destroyContato',$contato->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger mx-2">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
