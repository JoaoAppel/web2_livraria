<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Client;
use App\Models\Book;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanController extends Controller
{
    public function index()
    {
        $emprestimos = Loan::with(['client', 'book'])
            ->orderBy('data_emprestimo', 'desc')
            ->paginate(10);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $clientes = Client::orderBy('nome')->get();
        $livros   = Book::orderBy('titulo')->get();

        return view('emprestimos.create', compact('clientes', 'livros'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'               => 'required|exists:clients,id',
            'book_id'                 => 'required|exists:books,id',
            'data_emprestimo'         => 'required|date',
            'data_prevista_devolucao' => 'required|date|after_or_equal:data_emprestimo',
        ]);

        $livro = Book::findOrFail($request->book_id);

        if ($livro->quantidade_disponivel <= 0) {
            return back()
                ->withErrors(['book_id' => 'Não há exemplares disponíveis deste livro.'])
                ->withInput();
        }

        Loan::create([
            'client_id'               => $request->client_id,
            'book_id'                 => $request->book_id,
            'data_emprestimo'         => $request->data_emprestimo,
            'data_prevista_devolucao' => $request->data_prevista_devolucao,
            'status'                  => 'aberto',
        ]);

        // reserva 1 exemplar
        $livro->decrement('quantidade_disponivel');

        return redirect()->route('emprestimos.index')
            ->with('success', 'Empréstimo registrado com sucesso!');
    }

    public function show(Loan $emprestimo)
    {
        $emprestimo->load(['client', 'book']);

        return view('emprestimos.show', compact('emprestimo'));
    }

    public function edit(Loan $emprestimo)
    {
        $emprestimo->load(['client', 'book']);

        $clientes = Client::orderBy('nome')->get();
        $livros   = Book::orderBy('titulo')->get();

        return view('emprestimos.edit', compact('emprestimo', 'clientes', 'livros'));
    }

    public function update(Request $request, Loan $emprestimo)
    {
        $request->validate([
            'client_id'               => 'required|exists:clients,id',
            'book_id'                 => 'required|exists:books,id',
            'data_emprestimo'         => 'required|date',
            'data_prevista_devolucao' => 'required|date|after_or_equal:data_emprestimo',
            'data_devolucao'          => 'nullable|date|after_or_equal:data_emprestimo',
            'status'                  => 'required|in:aberto,devolvido',
        ]);

        $statusAnterior = $emprestimo->status;
        $livroAnterior  = Book::findOrFail($emprestimo->book_id);
        $novoLivro      = Book::findOrFail($request->book_id);
        $novoStatus     = $request->status;

        // Se o novo status for "aberto" e:
        //  - o livro mudou OU
        //  - o status era "devolvido"
        // precisamos verificar disponibilidade no novo livro
        if ($novoStatus === 'aberto') {
            $precisaChecarDisponibilidade =
                !($statusAnterior === 'aberto' && $livroAnterior->id === $novoLivro->id);

            if ($precisaChecarDisponibilidade && $novoLivro->quantidade_disponivel <= 0) {
                return back()
                    ->withErrors(['book_id' => 'Não há exemplares disponíveis deste livro.'])
                    ->withInput();
            }
        }

        // Ajuste de estoque:
        // 1) devolve o exemplar do livro anterior, se o empréstimo estava aberto
        if ($statusAnterior === 'aberto') {
            $livroAnterior->increment('quantidade_disponivel');
        }

        // 2) se o novo status for "aberto", retira 1 exemplar do novo livro
        if ($novoStatus === 'aberto') {
            $novoLivro->decrement('quantidade_disponivel');
        }

        // Atualiza os dados do empréstimo
        $emprestimo->update([
            'client_id'               => $request->client_id,
            'book_id'                 => $request->book_id,
            'data_emprestimo'         => $request->data_emprestimo,
            'data_prevista_devolucao' => $request->data_prevista_devolucao,
            'data_devolucao'          => $request->data_devolucao,
            'status'                  => $novoStatus,
        ]);

        return redirect()->route('emprestimos.index')
            ->with('success', 'Empréstimo atualizado com sucesso!');
    }

    public function destroy(Loan $emprestimo)
    {
        // se ainda estiver aberto, devolve exemplar ao estoque
        if ($emprestimo->status === 'aberto') {
            $emprestimo->book->increment('quantidade_disponivel');
        }

        $emprestimo->delete();

        return redirect()->route('emprestimos.index')
            ->with('success', 'Empréstimo excluído com sucesso!');
    }

    public function relatorioPdf()
    {
        $emprestimos = Loan::with(['client', 'book'])
            ->orderBy('data_emprestimo', 'desc')
            ->get();

        $dataGeracao = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('relatorios.emprestimos', [
            'emprestimos' => $emprestimos,
            'dataGeracao' => $dataGeracao,
        ])->setPaper('a4', 'landscape');

        return $pdf->download('relatorio_emprestimos.pdf');
    }
}
