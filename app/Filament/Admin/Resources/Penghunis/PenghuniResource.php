<?php

namespace App\Filament\Admin\Resources\Penghunis;

use App\Filament\Admin\Resources\Penghunis\Pages\CreatePenghuni;
use App\Filament\Admin\Resources\Penghunis\Pages\EditPenghuni;
use App\Filament\Admin\Resources\Penghunis\Pages\ListPenghunis;
use App\Filament\Admin\Resources\Penghunis\Schemas\PenghuniForm;
use App\Filament\Admin\Resources\Penghunis\Tables\PenghunisTable;
use App\Models\Penghuni;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PenghuniResource extends Resource
{
    protected static ?string $model = Penghuni::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    public static function form(Schema $schema): Schema
    {
        return PenghuniForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenghunisTable::configure($table);
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
            'index' => ListPenghunis::route('/'),
            'create' => CreatePenghuni::route('/create'),
            'edit' => EditPenghuni::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $adminKosId = \App\Models\Kos::where('user_id', Auth::id())->first()?->id;

        return parent::getEloquentQuery()
            ->with(['user.pembayarans', 'kos'])
            ->where(function ($query) use ($adminKosId) {
                $query->where('kos_id', $adminKosId)
                    ->orWhere(function ($query) use ($adminKosId) {
                        $query->whereNull('kos_id')
                            ->whereHas('user.pembayarans', function ($query) use ($adminKosId) {
                                $query->whereIn('status', ['pending', 'rejected'])
                                    ->where('kos_id', $adminKosId);
                            });
                    });
            });
    }
}
