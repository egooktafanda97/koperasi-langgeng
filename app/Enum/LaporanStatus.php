<?php

namespace App\enum;

enum StatusLaporanEnum: string
{
    case MENUNGGU = 'menunggu';
    case DITERIMA = 'diterima';
    case DITOLAK = 'ditolak';

    /**
     * Untuk select dropdown atau mapping
     */
    public static function options(): array
    {
        return [
            self::MENUNGGU->value => 'Menunggu',
            self::DITERIMA->value => 'Diterima',
            self::DITOLAK->value => 'Ditolak',
        ];
    }

    /**
     * Label berwarna (optional)
     */
    public function badge(): string
    {
        return match ($this) {
            self::MENUNGGU => '<span class="badge bg-warning text-dark">Menunggu</span>',
            self::DITERIMA => '<span class="badge bg-success">Diterima</span>',
            self::DITOLAK => '<span class="badge bg-danger">Ditolak</span>',
        };
    }
}
