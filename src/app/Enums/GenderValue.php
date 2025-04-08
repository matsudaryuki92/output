<?php

namespace App\Enums;

enum Role: int
{
    case MAN = 1;
    case WOMAN = 2;
    case OTHER = 3;

    public function label(): string
    {
        return match ($this) {
            Role::MAN => '男性',
            Role::WOMAN => '女性',
            Role::OTHER => 'その他',
        };
    }
}

// 一旦ステイします
