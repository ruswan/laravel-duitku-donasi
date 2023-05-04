<?php

namespace App\Filament\Resources\CampaignResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonasiRelationManager extends RelationManager
{
    protected static string $relationship = 'donasis';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_name'),
                Tables\Columns\TextColumn::make('user_email'),
                Tables\Columns\TextColumn::make('user_phone'),
                Tables\Columns\TextColumn::make('paid'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}
