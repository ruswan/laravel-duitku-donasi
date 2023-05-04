<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DonasiResource\Pages;
use App\Filament\Resources\DonasiResource\RelationManagers;
use App\Models\Donasi;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('campaign_id')
                    ->required(),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('payment_url')
                    ->maxLength(255),
                Forms\Components\TextInput::make('method')
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user_phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required(),
                Forms\Components\TextInput::make('paid'),
                Forms\Components\TextInput::make('duitku_ref')
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('expired_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('campaign_id'),
                Tables\Columns\TextColumn::make('user_name'),
                Tables\Columns\TextColumn::make('user_email'),
                Tables\Columns\TextColumn::make('user_phone'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('paid'),
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
            'index' => Pages\ListDonasis::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'view' => Pages\ViewDonasi::route('/{record}'),
            'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }
}
