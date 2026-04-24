<?php

namespace App\Repositories;

use App\Models\User;
use Arafat\LaravelRepository\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{
    /**
     * base method
     *
     * @method model()
     */
    public static function model()
    {
        return User::class;
    }

    public static function storeByRequest(Request $request)
    {
        $media = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $media = MediaRepository::storeByRequest($image, 'user', 'image');
        }
        $user = self::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'media_id' => $media?->id ?? null,
        ]);

        $user->assignRole($request->role ?? null);

        return $user;
    }

    public static function updateByRequest(Request $request, User $user): User
    {
        $media = $user->media;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $media = MediaRepository::updateOrCreateByRequest($image, 'user', 'image', $media);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'media_id' => $media?->id ?? null,
        ]);

        return $user;
    }
}
