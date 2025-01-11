<?php

namespace App\Console\Commands;

use App\Models\Cuisine;
use App\Models\SetMenu;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchSetMenus extends Command
{
    protected $signature = 'app:fetch-set-menus';
    protected $description = 'Fetch set menus and store them in the database';

    public function handle()
    {
        $limit = 1;
        $url = 'https://staging.yhangry.com/booking/test/set-menus';

        do {
            $response = Http::get($url);

            if ($response->ok()) {
                $data = $response->json();

                foreach ($data['data'] as $menuData) {
                    $cuisineIds = [];

                    $menu = SetMenu::updateOrCreate(
                        ['name' => $menuData['name']],
                        [
                            'description' => $menuData['description'],
                            'price_per_person' => $menuData['price_per_person'],
                            'min_spend' => $menuData['min_spend'],
                            'available' => $menuData['available'],
                            'number_of_orders' => $menuData['number_of_orders'],
                            'thumbnail' => $menuData['thumbnail'],
                        ]
                    );

                    foreach ($menuData['cuisines'] as $cuisineData) {
                        $cuisine = Cuisine::firstOrCreate(['name' => $cuisineData['name']]);
                        $cuisineIds[] = $cuisine->id;
                    }

                    $menu->cuisines()->sync($cuisineIds);
                }

                $url = $data['links']['next'];
            } else {
                $this->error('Failed to fetch data');
                break;
            }

            sleep($limit);
        } while ($url);

        $this->info('Data fetched successfully');
    }
}
