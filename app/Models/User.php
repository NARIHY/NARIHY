<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use SolutionForest\FilamentAccessManagement\Concerns\FilamentUserHelpers;
use Spatie\Permission\Traits\HasRoles;
use TomatoPHP\FilamentSocial\Traits\InteractsWithSocials;

class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, FilamentUserHelpers, HasRoles, InteractsWithSocials;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, '@narihy.mg') && $this->hasVerifiedEmail();
    }

    public function authoredNewsLetters()
    {
        return $this->hasMany(Newsletter::class, 'author_id');
    }

    public function authoredBlogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function editNewsletters()
    {
        return $this->belongsToMany(Newsletter::class, 'newsletter_user')->withTimestamps();
    }
}
