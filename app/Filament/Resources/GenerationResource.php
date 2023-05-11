<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GenerationResource\Pages;
use App\Filament\Resources\GenerationResource\RelationManagers;
use App\Models\Generation;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GenerationResource extends Resource
{
    protected static ?string $model = Generation::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $modelLabel = 'Angkatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema(
                    [
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Angkatan'),
                    ]
                )
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID Angkatan')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Angkatan')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListGenerations::route('/'),
            'create' => Pages\CreateGeneration::route('/create'),
            'view' => Pages\ViewGeneration::route('/{record}'),
            'edit' => Pages\EditGeneration::route('/{record}/edit'),
        ];
    }
}
