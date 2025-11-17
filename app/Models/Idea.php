<?php

namespace App\Models;

use App\Enums\OrganizerStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'titulo', 
        'descricao', 
        'nome_cliente', 
        'prazo', 
        'status',
        'plataforma',
        'tipo_conteudo',
        'anexos',
        'imagens_descricao',
    ];

    protected $casts = [
        'prazo'  => 'date',
        'status' => OrganizerStatus::class,
        'anexos' => 'array',
        'imagens_descricao' => 'array',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Indicar que cada ideia pertence a um usuário
    }

    public function scopeMine($query) // $query representa uma consulta no banco de dados
    {
        return $query->where('user_id', auth()->id()); // Retorna só as ideias do usuário autenticado
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
        return $query;
    }

    public function getPlataformaLabelAttribute(): string
    {
        $plataformas = [
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'tiktok' => 'TikTok',
            'linkedin' => 'LinkedIn',
            'twitter' => 'Twitter/X',
            'youtube' => 'YouTube',
            'pinterest' => 'Pinterest',
            'outras' => 'Outras',
        ];

        return $plataformas[$this->plataforma] ?? '—';
    }

    public function getTipoConteudoLabelAttribute(): string
    {
        $tipos = [
            'reels' => 'Reels',
            'carrossel' => 'Carrossel',
            'post_unico' => 'Post Único',
            'stories' => 'Stories',
            'video' => 'Vídeo',
            'artigo' => 'Artigo',
            'thread' => 'Thread',
        ];

        return $tipos[$this->tipo_conteudo] ?? '—';
    }

    
}