<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $livros = Book::orderBy('titulo')->paginate(10);

        return view('livros.index', compact('livros'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'               => 'required|string|max:255',
            'autor'                => 'required|string|max:255',
            'ano_publicacao'       => 'nullable|integer',
            'isbn'                 => 'nullable|string|max:50',
            'quantidade_total'     => 'required|integer|min:0',
            'quantidade_disponivel'=> 'required|integer|min:0',
        ]);

        Book::create($request->only(
            'titulo',
            'autor',
            'ano_publicacao',
            'isbn',
            'quantidade_total',
            'quantidade_disponivel'
        ));

        return redirect()->route('livros.index')
            ->with('success', 'Livro cadastrado com sucesso!');
    }

    public function show(Book $livro)
    {
        return view('livros.show', compact('livro'));
    }

    public function edit(Book $livro)
    {
        return view('livros.edit', compact('livro'));
    }

    public function update(Request $request, Book $livro)
    {
        $request->validate([
            'titulo'               => 'required|string|max:255',
            'autor'                => 'required|string|max:255',
            'ano_publicacao'       => 'nullable|integer',
            'isbn'                 => 'nullable|string|max:50',
            'quantidade_total'     => 'required|integer|min:0',
            'quantidade_disponivel'=> 'required|integer|min:0',
        ]);

        $livro->update($request->only(
            'titulo',
            'autor',
            'ano_publicacao',
            'isbn',
            'quantidade_total',
            'quantidade_disponivel'
        ));

        return redirect()->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }

    public function destroy(Book $livro)
    {
        $livro->delete();

        return redirect()->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }
}
