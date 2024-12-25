<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FilesResource\Pages;
use App\Filament\Resources\FilesResource\RelationManagers;
use App\Models\Files;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FilesResource extends Resource
{
    protected static ?string $model = Files::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('document_title')
                            ->label('Entrer le nom de votre document')
                            ->unique()
                            ->required(),

                FileUpload::make('paths')
                                ->label('Entrer le fichier ici')
                                ->disk('public') // Choisissez le disque où vous souhaitez stocker les médias (ici 'public')
                                ->directory('media'. DIRECTORY_SEPARATOR.  'files'. DIRECTORY_SEPARATOR. date('Y-m-d').DIRECTORY_SEPARATOR. date('h-i-s'))
                                ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document_title')
                            ->sortable()
                            ->searchable(),
                ViewColumn::make('paths')
                            ->label('fichier')
                            ->view('download.files-download'),

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
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFiles::route('/create'),
            'edit' => Pages\EditFiles::route('/{record}/edit'),
        ];
    }
}
