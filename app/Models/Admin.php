<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;

class Admin extends Authenticatable implements FilamentUser, HasAvatar
{
    use Notifiable;
    protected $guarded = [];
    protected $hidden = ['password'];

    public function getFilamentAvatarUrl(): ?string
    {
        return Storage::url($this->avatar);
    }
    
    public function canAccessPanel(Panel $panel): bool  // Add the Panel parameter
    {
        // Implement your access logic using $panel if needed
        return true;
    }
}
