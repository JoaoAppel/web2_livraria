<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'book_id',
        'data_emprestimo',
        'data_prevista_devolucao',
        'data_devolucao',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
