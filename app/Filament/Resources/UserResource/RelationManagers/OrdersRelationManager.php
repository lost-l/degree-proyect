<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrdersRelationManager extends RelationManager
{
    protected static string $relationship = 'orders';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->searchable()->sortable(),
                TextColumn::make('claim')->searchable()->sortable(),
                TextColumn::make('total')->sortable()->searchable(),
                TextColumn::make('iva')->sortable(),
                TextColumn::make('user_id')
                    ->label('cliente')
                    ->sortable()->searchable(),
                TextColumn::make('address')
                    ->label('dirección')->searchable(),
                TextColumn::make('delivery_id')
                    ->label('repartidor')
                    ->sortable()->searchable(),
                TextColumn::make('state.name')->sortable()->searchable(),
                TextColumn::make('delivery_date')
                    ->label('fecha de entrega')
                    ->searchable()->sortable(),
                TextColumn::make('created_at')
                    ->label('fecha de elaboración')
                    ->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
