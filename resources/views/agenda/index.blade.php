@extends('layouts.app')

@section('css')

@endsection
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header row">
                <div class="col-4">
                    @if($search)
                        <h1>Pesquisando por: {{$search}}</h1>
                    @else
                        <h1>Contatos</h1>
                    @endif
                </div>
                <div class="col-6">
                    <form class="form-inline" action="/" method="GET">
                        <input class="form-control mr-sm-2" name="search" id="search" type="search" placeholder="Search"
                               aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
                <div class="col-2">
                    <a href="{{ route('createContatos') }}" class="btn btn-primary btn-sm float-right">Novo</a>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive border-0">
                    <table class="table table-hover" style="margin-bottom: inherit">
                        <tbody>
                        @foreach ($contatos as $contato)
                            <tr>
                                <td>
                                    <a href="{{ url('agenda/'.$contato->id) }}">
                                        <img src="/img/contatos/{{ $contato->avatar }}"
                                             style="width: 30px;height: 30px;border: 1px solid #c0c0c0;border-radius: 5px;"
                                             class="img-avatar-xs">
                                    </a>
                                </td>
                                <td><a class='a-line' href="{{ url('agenda/'.$contato->id) }}">{{ $contato->nome }}</a>
                                </td>
                                <td class="d-none d-md-table-cell"><a class='a-line'
                                                                      href="{{ url('contatos/'.$contato->id) }}">{{ $contato->telefone }}</a>
                                </td>
                                <td class="d-none d-md-table-cell"><a class='a-line'
                                                                      href="{{ url('contatos/'.$contato->id) }}">{{ $contato->email }}</a>
                                </td>
                                <td class="d-none d-md-table-cell d-flex justify-content-center mb-2">
                                    <div class="row">
                                        <a href="{{route('editContato', $contato->id)}}"
                                           class="btn btn-outline-primary mx-2">
                                            <i class="fas fa-user-edit"></i></a>
                                        <form action="{{route('destroyContato',$contato->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger mx-2">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('javascript')

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

    <script type="text/javascript">
        var path = "{{ route('search') }}";
        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        })
    </script>
{{--    <script type="text/javascript">--}}
{{--        var route = "/search";--}}

{{--        $('#search').typeahead({--}}
{{--            source: function (query, process) {--}}
{{--                return $.get(route, {--}}
{{--                    query: query--}}
{{--                }, function (data) {--}}
{{--                    return process(data);--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
@endsection
