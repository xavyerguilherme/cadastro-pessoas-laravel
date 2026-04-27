@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-0">Pessoas cadastradas</h1>
        <a href="{{ route('pessoas.create') }}" class="btn btn-success">Nova pessoa</a>
    </div>

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th>Data de nascimento</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pessoas as $pessoa)
                        <tr>
                            <td>{{ $pessoa->nome }}</td>
                            <td>{{ $pessoa->email }}</td>
                            <td>{{ $pessoa->telefone }}</td>
                            <td>{{ $pessoa->data_nascimento ? \Carbon\Carbon::parse($pessoa->data_nascimento)->format('d/m/Y') : '-' }}</td>
                            <td class="text-end">
                                <a href="{{ route('pessoas.edit', $pessoa) }}" class="btn btn-sm btn-warning">Editar</a>
                                <form action="{{ route('pessoas.destroy', $pessoa) }}" method="POST" class="d-inline formulario-exclusao">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Nenhuma pessoa cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $pessoas->links() }}
    </div>
@endsection
