<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'ano_publicacao',
        'isbn',
        'quantidade_total',
        'quantidade_disponivel',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
