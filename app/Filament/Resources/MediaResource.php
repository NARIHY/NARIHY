<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MediaResource\Pages;
use App\Models\Media;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use OpenSpout\Common\Entity\Style\CellAlignment;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $navigationIcon = 'heroicon-c-folder';
    protected static ?string $navigationLabel = 'Médias';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // Champ texte pour le nom du média
            TextInput::make('name')
                ->required()
                ->label('Nom du média'),

            // Champ URL pour le lien du média (si applicable)
            TextInput::make('url')
                ->required()
                ->label('URL'),

            // Champ de téléchargement de média (uniquement pour l'ajout ou la modification de l'image)
            FileUpload::make('media')  // Ce champ permet d'ajouter un fichier
                ->label('Télécharger une image')
                ->disk('public') // Choisissez le disque où vous souhaitez stocker les médias (ici 'public')
                ->directory('media/images')  // Optionnel : spécifiez le répertoire de stockage
                ->image()  // Permet de n'accepter que des images
                ->nullable()  // Autoriser le champ à être vide si l'image n'est pas modifiée
        ]);
    }


    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('url')
                    ->searchable(),

                ImageColumn::make('media')
                    ->label('Image')
                    ->disk('public') // Si vous utilisez le disque public pour les médias
                    ->width(100)
                    ->height(100)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('view-media')
                    ->label('View Media')
                    ->modalHeading(fn($record) => $record->name)
                    ->modalFooterActionsAlignment(CellAlignment::CENTER)
                    ->modalContent(fn($record) => view('filament.resources.media-modal', [
                        'mediaUrl' => $record->getFirstMediaUrl('images'),  // Affiche le premier média attaché à la collection 'images'
                    ])),
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
            'index' => Pages\ListMedia::route('/'),
            'create' => Pages\CreateMedia::route('/create'),
            'edit' => Pages\EditMedia::route('/{record}/edit'),
        ];
    }
}
