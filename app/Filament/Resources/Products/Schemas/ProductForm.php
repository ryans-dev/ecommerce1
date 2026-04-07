<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Textarea::make('short_description')
                    ->required()
                    ->columnSpanFull(),
                RichEditor::make('full_description')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->prefix('$'),
                TextInput::make('quantity')
                    ->required()
                    ->numeric()
                    ->default(20),
                Hidden::make('image_path')
                    ->default('/images/products/')
                    ->dehydrated(true),
                FileUpload::make('image_name')
                    ->image()
                    ->disk('images')
                    ->required(),
                TextInput::make('category')
                    ->required(),
                Select::make('classification')
                    ->options([
                        'default' => 'Default',
                        'exclusive' => 'Exclusive',
                        'featured' => 'Featured',
                        'upcoming' => 'Upcoming',
                    ]),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);
    }
}
