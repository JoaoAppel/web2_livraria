<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Book;
use App\Models\Loan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes       = Client::count();
        $totalLivros         = Book::count();
        $totalEmprestimos    = Loan::count();
        $emprestimosAbertos  = Loan::where('status', 'aberto')->count();

        $ultimosEmprestimos = Loan::with(['client', 'book'])
            ->orderBy('data_emprestimo', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalLivros',
            'totalEmprestimos',
            'emprestimosAbertos',
            'ultimosEmprestimos'
        ));
    }
}
