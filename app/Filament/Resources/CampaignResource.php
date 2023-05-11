<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CampaignResource\Pages;
use App\Filament\Resources\CampaignResource\RelationManagers;
use App\Filament\Resources\CampaignResource\RelationManagers\DonasiRelationManager;
use App\Models\Campaign;
use App\Models\CampaignStatus;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';

    protected static ?string $navigationGroup = 'Penggalangan Dana';

    protected static ?string $navigationLabel = 'Kegiatan';

    protected static ?string $label = 'Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Nama Kegiatan'),

                        RichEditor::make('description')
                            ->required()
                            ->maxLength(65535)
                            ->label('Deskripsi'),

                        FileUpload::make('image')
                            ->required()
                            ->label('Cover'),
                    ])
                    ->columnSpan(2),

                Card::make()
                    ->schema([
                        TextInput::make('amount')
                            ->required()
                            ->label('Target yang ditetapkan'),


                        DatePicker::make('expired_at')
                            ->label('Waktu Terakhir Penggalangan Dana'),

                        Select::make('campaign_status_id')
                            ->label('Status')
                            ->options(CampaignStatus::all()
                                ->pluck('name', 'id'))
                            ->required(),
                    ])
                    ->columnSpan(1),

            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Kegiatan'),

                ImageColumn::make('image')
                    ->square()
                    ->label('Cover'),

                TextColumn::make('campaignStatus.name')
                    ->sortable()
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Dibuat Pada'),

            ])
            ->defaultSort('created_at', 'desc')

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
            DonasiRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'view' => Pages\ViewCampaign::route('/{record}'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}
