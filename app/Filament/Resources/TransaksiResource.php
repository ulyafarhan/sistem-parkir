<?php

namespace App\Filament\Resources;

use App\Models\Transaksi;
use App\Filament\Resources\TransaksiResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// Import untuk kolom
use Filament\Tables\Columns\TextColumn;

class TransaksiResource extends Resource
{
    protected static ?string $model = Transaksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // Kita tidak perlu membuat data baru dari sini, jadi matikan tombol 'Create'
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // (Kita tidak akan mengedit form, jadi biarkan saja)
            ]);
    }

    /**
     * ==========================================================
     * VERSI PERBAIKAN TABEL LAPORAN (FIXED)
     * ==========================================================
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // 1. Tampilkan ID Tiket, buat bisa dicari (searchable)
                TextColumn::make('id_tiket')
                    ->label('ID Tiket')
                    ->searchable(),

                // 2. Tampilkan Nama Jenis Kendaraan (dari relasi)
                TextColumn::make('jenisKendaraan.nama_jenis')
                    ->label('Jenis Kendaraan')
                    ->badge()
                    ->searchable(),

                // 3. Tampilkan Nama Petugas (dari relasi)
                TextColumn::make('petugas.name')
                    ->label('Petugas Keluar')
                    ->searchable()
                    ->default('-'), // Ini aman karena bukan kolom tanggal

                // 4. Tampilkan Jam Masuk (Ini tidak akan pernah null)
                TextColumn::make('jam_masuk')
                    ->dateTime('d M Y, H:i') // Format tanggalnya
                    ->sortable()
                    ->label('Waktu Masuk'),

                // 5. Tampilkan Jam Keluar
                TextColumn::make('jam_keluar')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->label('Waktu Keluar')
                    ->placeholder('-'), // <-- PERBAIKAN: Gunakan placeholder() untuk kolom tanggal

                // 6. Tampilkan Total Biaya (Format sebagai Rupiah)
                TextColumn::make('total_biaya')
                    ->label('Total Biaya')
                    ->money('IDR')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ])
            // Urutkan berdasarkan yang paling baru masuk
            ->defaultSort('jam_masuk', 'desc');
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksis::route('/'),
            // 'create' => Pages\CreateTransaksi::route('/create'),
            // 'edit' => Pages\EditTransaksi::route('/{record}/edit'),
        ];
    }    
}