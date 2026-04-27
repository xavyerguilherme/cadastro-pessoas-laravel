<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::orderBy('nome')->paginate(10);

        return view('pessoas.index', compact('pessoas'));
    }

    public function create()
    {
        return view('pessoas.create');
    }

    public function store(Request $request)
    {
        $dadosValidados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:pessoas,email'],
            'telefone' => ['required', 'string', 'max:20'],
            'data_nascimento' => ['nullable', 'date'],
        ]);

        Pessoa::create($dadosValidados);

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa cadastrada com sucesso!');
    }

    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    public function update(Request $request, Pessoa $pessoa)
    {
        $dadosValidados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:pessoas,email,' . $pessoa->id],
            'telefone' => ['required', 'string', 'max:20'],
            'data_nascimento' => ['nullable', 'date'],
        ]);

        $pessoa->update($dadosValidados);

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Cadastro atualizado com sucesso!');
    }

    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return redirect()
            ->route('pessoas.index')
            ->with('success', 'Pessoa removida com sucesso!');
    }
}
