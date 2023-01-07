<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request)
    {
        $user = $request->user();

        if ($user !== null) {
            $permissions = array_map(function ($permission) {
                return $permission['name'];
            }, $user->getAllPermissions()->toArray());

            $user = $user->toArray();
            unset($user['permissions']);
            unset($user['roles']);
            $user['permissions'] = $permissions;
        }

        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
            ],
        ]);
    }
}
