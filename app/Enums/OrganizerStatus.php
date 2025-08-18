<?php

namespace App\Enums;

enum OrganizerStatus: string
{
    case EM_ANDAMENTO = 'em_andamento';
    case CONCLUIDO    = 'concluido';
    case IDEIAS       = 'ideias';

    public static function labels(): array
    {
        return [
            self::EM_ANDAMENTO->value => 'Em andamento',
            self::CONCLUIDO->value    => 'Concluído',
            self::IDEIAS->value       => 'Ideias',
        ];
    }
}
