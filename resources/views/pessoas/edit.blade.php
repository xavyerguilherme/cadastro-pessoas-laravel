@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h1 class="h4 mb-4">Editar cadastro</h1>

            <form action="{{ route('pessoas.update', $pessoa) }}" method="POST">
                @method('PUT')
                @include('pessoas._form', ['botaoSubmit' => 'Atualizar cadastro'])
            </form>
        </div>
    </div>
@endsection
