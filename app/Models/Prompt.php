<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'type',
        'input_data',
        'result',
        'favorited',
    ];

    /**
     * Conversão automática de campos JSON para array
     */
    protected $casts = [
        'input_data' => 'array',
        'favorited' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: buscar por tipo
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope: buscar favoritados
     */
    public function scopeFavorited($query)
    {
        return $query->where('favorited', true);
    }

    /**
     * Labels amigáveis para os tipos
     */
    public static function getTypeLabels()
    {
        return [
            'legenda' => 'Legenda para Post',
            'paleta' => 'Paleta de Cores',
            'ideias' => 'Ideias de Conteúdo',
            'hashtags' => 'Sugestões de Hashtags',
            'cta' => 'Call-to-Action',
        ];
    }

    /**
     * Ícones Bootstrap (retorna HTML dos ícones)
     */
    public static function getTypeIcons()
    {
        return [
            'legenda' => '<i class="bi bi-pencil-square"></i>',
            'paleta' => '<i class="bi bi-palette-fill"></i>',
            'ideias' => '<i class="bi bi-lightbulb-fill"></i>',
            'hashtags' => '<i class="bi bi-hash"></i>',
            'cta' => '<i class="bi bi-cursor-fill"></i>',
        ];
    }
}