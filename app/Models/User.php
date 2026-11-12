<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public const string DEFAULT_THEME_COLOR = '#ff5722';

    /**
     * Curated dashboard color theme presets.
     *
     * @var array<int, array{name: string, color: string}>
     */
    public const array THEME_COLOR_PRESETS = [
        ['name' => 'Orange', 'color' => '#ff5722'],
        ['name' => 'Indigo', 'color' => '#6366f1'],
        ['name' => 'Ocean', 'color' => '#0ea5e9'],
        ['name' => 'Emerald', 'color' => '#10b981'],
        ['name' => 'Rose', 'color' => '#f43f5e'],
        ['name' => 'Violet', 'color' => '#8b5cf6'],
        ['name' => 'Amber', 'color' => '#f59e0b'],
        ['name' => 'Teal', 'color' => '#14b8a6'],
    ];

    protected $fillable = [
        'name',
        'name_en',
        'name_ar',
        'username',
        'email',
        'password',
        'mobile_no',
        'gender',
        'role',
        'joined_date',
        'active',
        'theme_color',
        'is_delete',
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
            'active' => 'integer',
            'is_delete' => 'integer',
        ];
    }

    /**
     * Get the user's display name.
     */
    public function getNameAttribute(): string
    {
        return $this->name_en ?? $this->username ?? $this->email ?? '';
    }

    /**
     * Resolve CSS palette tokens for the user's preferred theme color.
     *
     * @return array{primary: string, primary_dark: string, primary_rgb: string}
     */
    public static function resolveThemePalette(?string $hex = null): array
    {
        $color = is_string($hex) && preg_match('/^#[0-9A-Fa-f]{6}$/', $hex)
            ? strtolower($hex)
            : self::DEFAULT_THEME_COLOR;

        $r = hexdec(substr($color, 1, 2));
        $g = hexdec(substr($color, 3, 2));
        $b = hexdec(substr($color, 5, 2));

        $darken = static fn (int $channel): int => max(0, (int) round($channel * 0.86));
        $darkHex = sprintf('#%02x%02x%02x', $darken($r), $darken($g), $darken($b));

        return [
            'primary' => $color,
            'primary_dark' => $darkHex,
            'primary_rgb' => "{$r}, {$g}, {$b}",
        ];
    }
}
