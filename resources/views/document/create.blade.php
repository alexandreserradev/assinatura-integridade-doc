@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cadastrar Documento</div>

                <div class="card-body">
                    <form method="post" action="{{ route('documents.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" placeholder="Nome do documento" name="name">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" class="form-control" placeholder="Descrição do documento" name="description">
                        </div>

                        <h4>Documento</h4>
                        <textarea id="summernote" name="body"></textarea>

                        <hr>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection