<?php

namespace App\Enum;
enum SupportEnum: string
{
    case P = "Pendente";
    case A = "Aberto";
    case C = "Finalizado";

    public static function fromValue(string $name): string
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status->value;
            }
        }

        throw new \ValueError("$status is not a valid");
    }
}
