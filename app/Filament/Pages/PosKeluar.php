<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class PosKeluar extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';

    protected static string $view = 'filament.pages.pos-keluar';

    // Set rute kustom sesuai brief
    protected static ?string $slug = 'pos-keluar';
}