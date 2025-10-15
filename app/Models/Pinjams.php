<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjams extends Model
{
    use HasFactory;

    protected $table = 'pinjam';
    protected $fillable = ['book_id'];
    protected $primaryKey = 'id';
}
