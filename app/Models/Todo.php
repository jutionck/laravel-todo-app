<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    // Memastikan model terhubung ke tabel todos
    protected $table = 'todos';
    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = ['task', 'is_done'];
    // Laravel secara default menggunakan timestamps (created_at dan updated_at)
    public $timestamps = true;
}
