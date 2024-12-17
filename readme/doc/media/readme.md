## Link: https://filamentphp.com/plugins/hugomyb-media-action*

# Installation
Vous pouvez installer le paquet via composer:

composer require hugomyb/filament-media-action
Vous pouvez éventuellement publier la vue en utilisant

php artisan vendor:publish --tag="filament-media-action-views"
En option, vous pouvez publier les traductions en utilisant

php artisan vendor:publish --tag="filament-media-action-translations"
# Usage
# Utilisation de Base
Comme une Action Filament classique, vous pouvez utiliser MediaAction n'importe où (Formulaires, Tables, Infolistes, Suffixe et préfixe, ..).

Il suffit de fournir l'url de votre média dans le ->media() méthode. Le package détectera alors automatiquement votre extension multimédia pour l'affichage.

MediaAction::make('tutorial')
    ->iconButton()
    ->icon('heroicon-o-video-camera')
    ->media('https://www.youtube.com/watch?v=rN9XI9KCz0c&list=PL6tf8fRbavl3jfL67gVOE9rF0jG5bNTMi')
# Options disponibles
# Autoplay
Vous pouvez activer la lecture automatique pour la vidéo et l'audio en utilisant ->autoplay() méthode.

MediaAction::make('media-url')
    ->media(fn($record) => $record->url)
    ->autoplay()
Vous pouvez également passer une fermeture dans la méthode et accéder $record et $mediaType :

MediaAction::make('media-url')
    ->media(fn($record) => $record->url)
    ->autoplay(fn($record, $mediaType) => $mediaType === 'video')
$mediatypepeut retourner "youtube", "audio", "vidéo", "image" ou "pdf".

# Précharge
Pour contrôler le comportement de précharge, utilisez la méthode ->preload(). Par défaut, il est défini sur true, ce qui signifie que le média se précharge automatiquement. Vous pouvez le définir sur false pour désactiver le préchargement (ceci est utile pour éviter les erreurs "Autoplay failed ou was blocked" dans certains navigateurs).

MediaAction::make('media-url')
    ->media(fn($record) => $record->url)
    ->autoplay()
    ->preload(false)
# Autres options
Vous pouvez personnaliser le modal comme vous le souhaitez de la même manière qu'une action classique (voir https://filamentphp.com/docs/3.x/actions/modals).

S'il y a un enregistrement existant, vous pouvez y accéder en passant une fermeture à ->media() méthode.

Exemple :

MediaAction::make('media-url')
    ->modalHeading(fn($record) => $record->name)
    ->modalFooterActionsAlignment(Alignment::Center)
    ->media(fn($record) => $record->url)
    ->extraModalFooterActions([
        MediaAction::make('media-video2')
            ->media('https://www.youtube.com/watch?v=9GBXqWKzfIM&list=PL6tf8fRbavl3jfL67gVOE9rF0jG5bNTMi&index=3')
            ->extraModalFooterActions([
                MediaAction::make('media-video3')
                    ->media('https://www.youtube.com/watch?v=Bvb_vqzhRQs&list=PL6tf8fRbavl3jfL67gVOE9rF0jG5bNTMi&index=5')
            ]),
 
        Tables\Actions\Action::make('open-url')
            ->label('Open in browser')
            ->url(fn($record) => $record->url)
            ->openUrlInNewTab()
            ->icon('heroicon-o-globe-alt')
    ])
Comme indiqué dans l'exemple ci-dessus, vous pouvez enchaîner MediaActions avec ->extraModalFooterActions() méthode.

#Customizing the modal view
You can customize the modal view by publishing the view using :

php artisan vendor:publish --tag="filament-media-action-views"
Then, in the view, you can access :

$mediaType: To retrieve the type of your media, which can be “youtube”, “audio”, “video”, “image” or “pdf”.
$media : To retrieve the url of your media
#Supported media extensions
Type	Extensions
Video	mp4, avi, mov, webm
Audio	mp3, wav, ogg, aac
Documents	pdf
Image	jpg, jpeg, png, gif, bmp, svg, webp
#Changelog
Please see CHANGELOG for more information on what has changed recently.

# Contributing
Please see CONTRIBUTING for details.

# Security Vulnerabilities
Please review our security policy on how to report security vulnerabilities.

# Credits
Mayonobe Hugo
All Contributors
#License
La Licence MIT (MIT). Veuillez voir Fichier de Licence pour plus d'informations.
