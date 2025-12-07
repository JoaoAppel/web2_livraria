<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Empréstimos</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        h1 {
            text-align: center;
            margin-bottom: 10px;
        }
        .info {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
        }
        .status-aberto {
            font-weight: bold;
        }
        .status-devolvido {
            font-weight: bold;
        }
        .footer {
            margin-top: 15px;
            text-align: right;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <h1>Relatório de Empréstimos</h1>

    <div class="info">
        <strong>Quantidade total:</strong> {{ $emprestimos->count() }}<br>
        <strong>Gerado em:</strong> {{ $dataGeracao }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Livro</th>
                <th>Data Empréstimo</th>
                <th>Prev. Devolução</th>
                <th>Data Devolução</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($emprestimos as $emprestimo)
                <tr>
                    <td>{{ $emprestimo->id }}</td>
                    <td>{{ $emprestimo->client->nome }}</td>
                    <td>{{ $emprestimo->book->titulo }}</td>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($emprestimo->data_prevista_devolucao)->format('d/m/Y') }}</td>
                    <td>
                        @if ($emprestimo->data_devolucao)
                            {{ \Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if ($emprestimo->status === 'aberto')
                            Aberto
                        @else
                            Devolvido
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">
                        Nenhum empréstimo encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Sistema de Livraria - Relatório de Empréstimos
    </div>
</body>
</html>
