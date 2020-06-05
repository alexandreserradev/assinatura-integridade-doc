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
                <div class="card-header d-flex">
                    Documentos 
                    <span class="ml-auto">
                        <a href="{{ route('documents.create') }}" class="btn btn-primary">Criar documento</a>
                    </span>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $document)
                                <tr>
                                    <td>{{ $document->id }}</td>
                                    <td>{{ $document->name }}</td>
                                    <td>{{ $document->description }}</td>
                                    <td>
                                        <a href="{{ route('documents.edit', $document->id) }}"><ion-icon size="large" name="create-outline"></ion-icon></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Nenhum documento</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
