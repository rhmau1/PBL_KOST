<?php

namespace App\Filament\Admin\Resources\Penghunis\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PenghuniForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->icon('heroicon-o-user')
                    ->description('Basic information about the tenant')
                    ->schema([
                        Group::make([
                            Select::make('user_id')
                                ->relationship('user', 'name')
                                ->label('User Account')
                                ->searchable()
                                ->preload(),
                            TextInput::make('nama')
                                ->label('Full Name')
                                ->required()
                                ->maxLength(255),
                        ])->columns(2),

                        Group::make([
                            TextInput::make('no_hp')
                                ->label('Phone Number')
                                ->tel()
                                ->required()
                                ->maxLength(255),
                            DatePicker::make('tanggal_masuk')
                                ->label('Entry Date')
                                ->required(),
                        ])->columns(2),

                        Textarea::make('alamat')
                            ->label('Address')
                            ->required()
                            ->columnSpanFull()
                            ->rows(3),
                    ])
                    ->columnSpanFull(),

                Section::make('Emergency Contact')
                    ->icon('heroicon-o-phone')
                    ->description('Contact person in case of emergency')
                    ->schema([
                        Group::make([
                            TextInput::make('nama_wali')
                                ->label('Guardian Name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('no_hp_wali')
                                ->label('Guardian Phone Number')
                                ->tel()
                                ->required()
                                ->maxLength(255),
                        ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
