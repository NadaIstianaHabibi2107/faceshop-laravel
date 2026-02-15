<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;   // ✅ FIX: Section dari Schemas
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Produk')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label('Nama Produk')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('brand')
                        ->label('Brand')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('category')
                        ->label('Kategori')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('price')
                        ->label('Harga')
                        ->required()
                        ->numeric()
                        ->prefix('Rp'),

                    TextInput::make('stock')
                        ->label('Stok')
                        ->required()
                        ->numeric()
                        ->minValue(0),

                    Select::make('skin_type')
                        ->label('Jenis Kulit')
                        ->options([
                            'Normal' => 'Normal',
                            'Berminyak' => 'Berminyak',
                            'Kering' => 'Kering',
                            'Kombinasi' => 'Kombinasi',
                            'Sensitif' => 'Sensitif',
                        ])
                        ->required(),

                    FileUpload::make('image')
                        ->label('Gambar Produk')
                        ->image()
                        ->disk('public')
                        ->directory('products')
                        ->visibility('public')
                        ->columnSpanFull(),

                    Textarea::make('description')
                        ->label('Deskripsi')
                        ->columnSpanFull(),
                ]),

            Section::make('Shades')
                ->description('Tambahkan shade untuk produk ini (bisa banyak).')
                ->schema([
                    Repeater::make('shades')
                        ->label('Daftar Shade')
                        ->relationship('shades') // pastikan relasi Product->shades ada
                        ->defaultItems(0)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['shade_name'] ?? null)
                        ->columns(6)
                        ->schema([
                            TextInput::make('shade_name')
                                ->label('Nama Shade')
                                ->required()
                                ->maxLength(255)
                                ->columnSpan(2),

                            Select::make('tone')
                                ->label('Skintone')
                                ->options([
                                    'fair' => 'Fair',
                                    'light' => 'Light',
                                    'medium' => 'Medium',
                                    'tan' => 'Tan',
                                    'deep' => 'Deep',
                                    'dark' => 'Dark',
                                ])
                                ->required()
                                ->columnSpan(2),

                            Select::make('undertone')
                                ->label('Undertone')
                                ->options([
                                    'warm' => 'Warm',
                                    'neutral' => 'Neutral',
                                    'cool' => 'Cool',
                                ])
                                ->required()
                                ->columnSpan(2),

                            ColorPicker::make('hex_color')
                                ->label('Hex Color')
                                ->required()
                                ->columnSpan(2),
                        ]),
                ]),
        ]);
    }
}
