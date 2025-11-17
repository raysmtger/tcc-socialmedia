<?php

namespace App\Enums;

enum OrganizerStatus: string
{
    case Ideias = 'ideias';
    case EmAndamento = 'em_andamento';
    case Concluido = 'concluido';

    public static function labels(): array
    {
        return [
            self::Ideias->value       => 'Ideias',
            self::EmAndamento->value  => 'Em andamento',
            self::Concluido->value    => 'Concluído',
        ];
    }

    /**
     * Retorna uma cor associada a cada status
     */
    public static function colors(): array
    {
        return [
            self::Ideias->value       => 'bg-warning text-dark',  
            self::EmAndamento->value  => 'bg-info text-dark',     
            self::Concluido->value    => 'bg-success text-white',
        ];
    }
}
