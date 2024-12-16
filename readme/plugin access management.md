#Installation
Assurez-vous que vous avez déjà installé le panneau Filament.

Vous pouvez installer le paquet via composer:

composer require solution-forest/filament-access-management
Ajoutez le trait nécessaire à votre modèle d'utilisateur:

 
use SolutionForest\FilamentAccessManagement\Concerns\FilamentUserHelpers;
 
class User extends Authenticatable
{
    use FilamentUserHelpers;
}
Effacez votre cache de configuration:

php artisan optimize:clear
# or
php artisan config:clear
Enregistrez le plugin dans votre fournisseur de Panel:

Important: Enregistrez le plugin dans votre fournisseur de Panel après la version 2.x

use SolutionForest\FilamentAccessManagement\FilamentAccessManagementPanel;
 
public function panel(Panel $panel): Panel
{
    return $panel
        ->plugin(FilamentAccessManagementPanel::make());
}
Exécutez ensuite les commandes suivantes:

php artisan filament-access-management:install
Si vous n'avez pas encore d'utilisateur nommé admin, cette commande crée un Super Admin Utilisateur avec les informations d'identification suivantes:

Nom: admin
Adresse e-mail: admin@("slug" pattern from config("app.name")).com
Mot de passe: admin
Vous pouvez également créer l'utilisateur super admin avec:

php artisan make:super-admin-user
Appelez la commande de mise à niveau pour mettre à niveau les données après la version 2.2.0

php artisan filament-access-management:upgrade
#Publier Configs, Vues, Traductions et Migrations
Vous pouvez publier les configs, vues, traductions et migrations avec:

php artisan vendor:publish --tag="filament-access-management-config"
 
php artisan vendor:publish --tag="filament-access-management-views"
 
php artisan vendor:publish --tag="filament-access-management-translations"
 
php artisan vendor:publish --tag="filament-access-management-migrations"
#Migration
php artisan migrate
#Usage
Lors de l'installation, les pages "Menu", "Utilisateurs", "Rôles" et "Permissions" seront créées. Chaque utilisateur a des rôles et chaque rôle a des autorisations.

