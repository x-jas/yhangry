<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use App\Models\SetMenu;
use Illuminate\Http\Request;

class SetMenuController extends Controller
{
    public function showSetMenus(Request $request)
    {
        $cuisine = $request->query('cuisine');
        $guests = $request->query('guests', 1);

        $cuisines = Cuisine::withCount(['setMenus' => function ($query) {
            $query->where('available', true);
        }])
            ->orderBy('set_menus_count', 'desc')
            ->get();

        $setMenus = SetMenu::with('cuisines')
            ->where('available', true)
            ->when($cuisine, function ($query) use ($cuisine) {
                $query->whereHas('cuisines', function ($q) use ($cuisine) {
                    $q->where('name', $cuisine);
                });
            })
            ->orderBy('number_of_orders', 'desc')
            ->paginate(10);

        return view('index', compact('cuisines', 'setMenus', 'guests'));
    }
}
