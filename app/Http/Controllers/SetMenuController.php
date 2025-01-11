<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SetMenu;
use App\Models\Cuisine;

class SetMenuController extends Controller
{
    public function showSetMenus(Request $request)
    {
        $cuisineSlug = $request->query('cuisineSlug');
        $guests = $request->query('guests', 1);

        $cuisines = Cuisine::withCount(['setMenus' => function ($query) {
            $query->where('available', true);
        }])
            ->orderBy('set_menus_count', 'desc')
            ->get();

        $setMenus = SetMenu::with('cuisines')
            ->where('available', true)
            ->when($cuisineSlug, function ($query) use ($cuisineSlug) {
                $query->whereHas('cuisines', function ($q) use ($cuisineSlug) {
                    $q->where('name', $cuisineSlug);
                });
            })
            ->orderBy('number_of_orders', 'desc')
            ->paginate(10);

        return view('index', compact('cuisines', 'setMenus', 'guests'));
    }
}
