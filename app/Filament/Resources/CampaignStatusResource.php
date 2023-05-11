<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignStatusResource\Pages;
use App\Filament\Resources\CampaignStatusResource\RelationManagers;
use App\Models\CampaignStatus;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampaignStatusResource extends Resource
{
    protected static ?string $model = CampaignStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $modelLabel = 'Status Kegiatan';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->name('Nama Status'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nama Status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCampaignStatuses::route('/'),
            'create' => Pages\CreateCampaignStatus::route('/create'),
            'edit' => Pages\EditCampaignStatus::route('/{record}/edit'),
        ];
    }
}
