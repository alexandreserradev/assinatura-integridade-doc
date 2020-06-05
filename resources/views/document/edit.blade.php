@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Documento</div>

                <div class="form-group m-3 d-flex">
                    <form action="{{ route('signatures.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="document_id" value="{{ $document->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-light btn-outline-info"><ion-icon size="large" name="pencil-outline"></ion-icon>Assinar</button>

                    </form>
                    <a href="{{ route('validar.documento', $document->id) }}" class="btn btn-light btn-outline-info ml-2"><ion-icon size="large" name="qr-code-outline"></ion-icon>Validar</a>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('documents.update', $document->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" value="{{ $document->name }}" class="form-control" placeholder="Nome do documento" name="name">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <input type="text" value="{{ $document->description }}" class="form-control" placeholder="Descrição do documento" name="description">
                        </div>

                        <h4>Documento</h4>
                        <textarea id="summernote" name="body">{!! $document->body !!}</textarea>

                        <hr>

                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div>
        @forelse ($document->getSignatures() as $signature)
            <h5> # Documento assinado por {{ $signature->getUser()->name }} - {{ $signature->created_at->format('d/m/Y H:i:s') }} 
                <span class="badge {{ $signature->validateSignature() ? ' badge-success' : 'badge-danger' }}">{{ $signature->validateSignature() ? 'Assinatura válida' : 'Assinatura inválida' }}</span>
            </h5>
            <hr>
        @empty
            <h5> Documento não assinado </h5>
        @endforelse
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