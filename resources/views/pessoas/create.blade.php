@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h1 class="h4 mb-4">Cadastrar pessoa</h1>

            <form action="{{ route('pessoas.store') }}" method="POST">
                @include('pessoas._form', ['botaoSubmit' => 'Salvar cadastro'])
            </form>
        </div>
    </div>
@endsection
