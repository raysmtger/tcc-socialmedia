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
            self::Ideias->value       => 'bg-yellow-200 text-yellow-800',
            self::EmAndamento->value  => 'bg-blue-200 text-blue-800',
            self::Concluido->value    => 'bg-green-200 text-green-800',
        ];
    }
}
