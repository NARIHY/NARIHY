<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterResource\Pages;
use App\Filament\Resources\NewsletterResource\RelationManagers;
use App\Models\Newsletter;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsletterResource extends Resource
{
    protected static ?string $model = Newsletter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                            ->label('Titre du newletter')
                            ->unique()
                            ->required(),
                Textarea::make('description')
                            ->label('Description')
                            ->required(),
                Select::make('media_id')
                            ->label('Media')
                            ->relationship('media','name')
                            ->nullable()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('file_id', null)),
                Select::make('file_id')
                            ->label('Fichier')
                            ->relationship('file','document_title')
                            ->nullable()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('media_id', null)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                                ->sortable(),
                TextColumn::make('title')
                        ->sortable()
                        ->label('titre')
                        ->searchable(),
                ImageColumn::make('media.media')
                        ->label('Image')
                        ->disk('public') // Si vous utilisez le disque public pour les médias
                        ->width(100)
                        ->height(100),
                ViewColumn::make('file.paths')
                        ->label('fichier')
                        ->sortable()
                        ->searchable()
                        ->view('download.files-download'),
                TextColumn::make('author.name')
                        ->label('Auteur')
                        ->sortable()
                        ->searchable(),
                TextColumn::make('editors')
                        ->label('Editeur')
                        ->getStateUsing(function($record) {
                            if (!$record->editors || $record->editors->isEmpty()) {
                                return '';
                            }

                            return $record->editors->pluck('name')->join(', ');
                        }),
                TextColumn::make('created_at')
                        ->label('Crée le')
                        ->dateTime(),
                TextColumn::make('updated_at')
                        ->label('Mis à jour le')
                        ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListNewsletters::route('/'),
            'create' => Pages\CreateNewsletter::route('/create'),
            'edit' => Pages\EditNewsletter::route('/{record}/edit'),
        ];
    }
}
