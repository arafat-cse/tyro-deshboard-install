<?php

namespace App\Http\Controllers\Dashboard;

use HasinHayder\Tyro\Models\Privilege;
use HasinHayder\TyroDashboard\Http\Controllers\PrivilegeController as BasePrivilegeController;
use Illuminate\Http\Request;

class PrivilegeController extends BasePrivilegeController
{
    public function index(Request $request)
    {
        $query = Privilege::withCount('roles');

        if ($search = $request->get('search')) {
            $query->where(function ($query) use ($search): void {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $privileges = $query->orderBy('slug')->get();

        return view('tyro-dashboard::privileges.index', $this->getViewData([
            'privileges' => $privileges,
            'filters' => $request->only(['search']),
        ]));
    }
}
