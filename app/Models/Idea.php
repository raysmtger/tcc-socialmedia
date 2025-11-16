<?php

namespace App\Models;

use App\Enums\OrganizerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'titulo', 'descricao', 'nome_cliente', 'prazo', 'status',
    ];

    //casts converte os tipos dos campos
    protected $casts = [
        'prazo'  => 'date',
        'status' => OrganizerStatus::class, 
    ];

    public function user()
    {
        return $this->belongsTo(User::class); //para indicar que cada ideia pertence a um usuário (graças ao user_id na tabela)
    }

    public function scopeMine($query) //$query representa uma consulta no banco de dados
    {
        return $query->where('user_id', auth()->id()); //retorna só as ideias do usuário autenticado
    }

    //filtrar por status
    public function scopeStatus($query, $status)
{
    if ($status) {
        $query->where('status', $status);
    }
    return $query;
}

}
