<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->disabled(),
                Forms\Components\TextInput::make('qty')
                    ->required()
                    ->numeric()
                    ->disabled(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled(),
            ])
            ->disabled(); // Nonaktifkan semua form fields untuk read-only
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('product.image')
                    ->label('Image')
                    ->square(),
                Tables\Columns\TextColumn::make('qty')
                    ->label('Quantity')
                    ->numeric(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('IDR'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Subtotal')
                    ->money('IDR')
                    ->getStateUsing(function ($record) {
                        return $record->price * $record->qty;
                    }),
            ])
            ->filters([
                // Tidak perlu filter untuk item pesanan
            ])
            ->headerActions([
                // Tidak ada aksi untuk menambah item (read-only)
            ])
            ->actions([
                // Tidak ada aksi untuk item (read-only)
            ])
            ->bulkActions([
                // Tidak ada bulk actions (read-only)
            ]);
    }
}