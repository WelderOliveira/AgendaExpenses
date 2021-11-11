@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="agenda">

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="evento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="" id="form" name="form">
                        @csrf
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" aria-describedby="">
                            {{--                            <small class=" form-text text-muted" id="helpId">Help Text</small>--}}
                        </div>

                        <div class="form-group">
                            <label for="title">Titulo do Evento</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="">
                            {{--                            <small class=" form-text text-muted" id="helpId">Help Text</small>--}}
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição do Evento</label>
                            <textarea name="descricao" id="descricao" cols="30" rows="10"
                                      class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="start">Start</label>
                            <input type="text" class="form-control" id="start" name="start" aria-describedby="">
                            {{--                            <small class=" form-text text-muted" id="helpId">Help Text</small>--}}
                        </div>

                        <div class="form-group">
                            <label for="end">End</label>
                            <input type="text" class="form-control" id="end" name="end" aria-describedby="">
                            {{--                            <small class=" form-text text-muted" id="helpId">Help Text</small>--}}
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
                    <button type="button" class="btn btn-warning" id="btnAlterar">Alterar</button>
                    <button type="button" class="btn btn-danger" id="btnExcluir">Excluir</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')

@endsection
