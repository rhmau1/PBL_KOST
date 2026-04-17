<?php

namespace App\Filament\Admin\Resources\Kamars\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class KamarForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Room Information')
                    ->icon('heroicon-o-home')
                    ->description('Basic information about the room')
                    ->schema([
                        Group::make([
                            TextInput::make('nomor')
                                ->required()
                                ->numeric()
                                ->unique(ignoreRecord: true, modifyRuleUsing: function (Unique $rule) {
                                    $kos = \App\Models\Kos::where('user_id', auth()->id())->first();
                                    return $rule->where('kos_id', $kos?->id);
                                }),
                            Select::make('jenis')->options([
                                'reguler' => 'Reguler',
                                'premium' => 'Premium',
                                'vip' => 'VIP',
                            ])->required(),
                        ])->columns(2),

                        Group::make([
                            TextInput::make('harga')->numeric()->prefix('Rp')->required(),
                            TextInput::make('ukuran')->numeric()->suffix('m²')->required(),
                        ])->columns(2),

                        Group::make([
                            Select::make('tipe_penghuni')->options([
                                'Putra' => 'Putra',
                                'Putri' => 'Putri',
                                'Campur' => 'Campur',
                            ])->default('Campur')->required(),
                            TextInput::make('kapasitas')->numeric()->default(1)->required(),
                        ])->columns(2),
                    ])
                    ->columnSpanFull(),

                Section::make('Details & Facilities')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->description('Room facilities and availability')
                    ->schema([
                        TagsInput::make('fasilitas')->required()->columnSpanFull(),

                        Group::make([
                            Toggle::make('is_available')->label('Available')->default(true),
                        ])->columns(2),
                    ])
                    ->columnSpanFull(),

                Section::make('Media & Extra Information')
                    ->icon('heroicon-o-photo')
                    ->description('Upload images and provide additional details')
                    ->schema([
                        FileUpload::make('images')
                            ->image()
                            ->multiple()
                            ->directory('room-images')
                            ->imagePreviewHeight('150')
                            ->panelLayout('grid')
                            ->columnSpanFull(),

                        RichEditor::make('keterangan')
                            ->extraAttributes(['style' => 'min-height: 300px;'])
                            ->columnSpanFull(),            
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
