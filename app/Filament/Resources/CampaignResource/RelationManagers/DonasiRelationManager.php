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

    protected static ?string $label = 'Donatur';

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
                Tables\Columns\TextColumn::make('user_name')
                    ->label('Nama Lengkap')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_phone')
                    ->label('No. HP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('paid')
                    ->label('Jumlah Donasi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu Donasi')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }

    protected function getTableQuery(): Builder
    {
        return parent::getTableQuery()->whereNotNull('paid');
    }
}
