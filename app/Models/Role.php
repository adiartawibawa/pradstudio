<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasUuids;

    /**
     * Daftar role yang tersedia di sistem.
     *
     */
    public const ROLES = [
        'Admin' => [
            'slug'        => 'admin',
            'description' => 'Super Administrator dengan akses penuh',
            'route'       => 'admin.dashboard',
        ],
        'Author' => [
            'slug'        => 'author',
            'description' => 'Author dapat membuat dan mengelola konten sendiri',
            'route'       => 'author.dashboard',
        ],
        'Contributor' => [
            'slug'        => 'contributor',
            'description' => 'Contributor dapat membuat draft tetapi perlu persetujuan',
            'route'       => 'contributor.dashboard',
        ],
        'User' => [
            'slug'        => 'user',
            'description' => 'User hanya dapat melihat dan mengubah profilnya',
            'route'       => 'user.dashboard',
        ],
    ];

    /**
     * Ambil daftar nama role (human readable).
     */
    public static function names(): array
    {
        return array_keys(self::ROLES);
    }

    /**
     * Ambil daftar slug role (machine friendly).
     */
    public static function slugs(): array
    {
        return array_column(self::ROLES, 'slug');
    }

    /**
     * Ambil deskripsi role berdasarkan nama.
     */
    public static function description(string $roleName): ?string
    {
        return self::ROLES[$roleName]['description'] ?? null;
    }

    /**
     * Ambil mapping slug => description.
     */
    public static function slugDescriptionMap(): array
    {
        return array_map(fn($role) => $role['description'], self::ROLES);
    }
}
