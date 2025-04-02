<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RestaurantOwnerResource\Pages;
use App\Filament\Admin\Resources\RestaurantOwnerResource\RelationManagers;
use App\Filament\Admin\Resources\RestaurantOwnerResource\RelationManagers\RestaurantsRelationManager;
use App\Models\RestaurantOwner;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class RestaurantOwnerResource extends Resource
{
    protected static ?string $model = RestaurantOwner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar')
                    ->label('Avatar')
                    ->avatar()
                    ->preserveFilenames(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->unique(RestaurantOwner::class, 'email', ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null) // Required on create, optional on edit
                    ->dehydrated(fn ($state) => filled($state)) // Only save if filled
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->circular()
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('restaurants_count')
                    ->counts('restaurants')
                    ->label('Restaurants'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RestaurantsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRestaurantOwners::route('/'),
            'create' => Pages\CreateRestaurantOwner::route('/create'),
            'edit' => Pages\EditRestaurantOwner::route('/{record}/edit'),
        ];
    }
}
