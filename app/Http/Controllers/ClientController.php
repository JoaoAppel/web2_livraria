<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clientes = Client::orderBy('nome')->paginate(10);

        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:clients,email',
            'telefone' => 'nullable|string|max:20',
        ]);

        Client::create($request->only('nome', 'email', 'telefone'));

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Client $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Client $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Client $cliente)
    {
        $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:clients,email,' . $cliente->id,
            'telefone' => 'nullable|string|max:20',
        ]);

        $cliente->update($request->only('nome', 'email', 'telefone'));

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Client $cliente)
    {
        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente excluído com sucesso!');
    }
}
