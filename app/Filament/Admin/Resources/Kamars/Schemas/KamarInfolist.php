<?php

namespace App\Filament\Admin\Resources\Kamars\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KamarInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Room Information')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Group::make([
                            TextEntry::make('nomor')
                                ->label('Room Number')
                                ->badge()
                                ->color('primary'),

                            TextEntry::make('jenis')
                                ->label('Room Type')
                                ->badge()
                                ->color(fn ($state) => match ($state) {
                                    'vip' => 'danger',
                                    'premium' => 'warning',
                                    default => 'success',
                                }),
                        ])->columns(2),

                        Group::make([
                            TextEntry::make('harga')->label('Price')->money('IDR'),
                            TextEntry::make('ukuran')->label('Size')->suffix(' m²'),
                        ])->columns(2),

                        Group::make([
                            TextEntry::make('tipe_penghuni')
                                ->label('Occupant Type')
                                ->badge()
                                ->color('info'),

                            TextEntry::make('kapasitas')->label('Capacity')->suffix(' Orang'),
                        ])->columns(2),
                    ])
                    ->columnSpanFull(),

                Section::make('Details & Facilities')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->schema([
                        TextEntry::make('fasilitas')
                            ->label('Facilities')
                            ->badge()
                            ->columnSpanFull(),

                        Group::make([
                            IconEntry::make('status')
                                ->label('Available')
                                ->boolean()
                                ->color(fn ($state) => $state ? 'success' : 'danger'),

                            IconEntry::make('is_furnished')
                                ->label('Furnished')
                                ->boolean()
                                ->color(fn ($state) => $state ? 'info' : 'gray'),
                        ])->columns(2),

                        TextEntry::make('keterangan')
                            ->label('Description')
                            ->html()
                            ->columnSpanFull(),

                        TextEntry::make('aturan_khusus')
                            ->label('Special Rules')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                Section::make('Media')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        ImageEntry::make('images')
                            ->label('Room Images')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
