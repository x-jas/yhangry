<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>yhangry - Set Menus</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="flex bg-white">
        <div class="w-full p-5">
            <h1 class="text-3xl mb-5">Set Menus</h1>

            <form class="mb-5" method="GET" action="{{ route('index') }}">
                <label for="guests">Guests:</label>
                <input id="guests" class="w-20 bg-gray-200 rounded p-1" name="guests" type="number" value="{{ request('guests', 1) }}" min="1" />
                <button class="bg-blue-500 text-white rounded p-1" type="submit">Update</button>
            </form>

            <div class="mb-5">
                <h2 class="text-xl mb-2">Filters</h2>
                <ul>
                    <li class="bg-gray-200 inline-flex rounded-full mb-1 p-1">
                        <a href="{{ route('index') }}">All Cuisines</a>
                    </li>

                    @foreach ($cuisines as $cuisine)
                        <li class="bg-gray-200 inline-flex rounded-full mb-1 p-1">
                            <a href="{{ route('index', ['cuisine' => $cuisine->name, 'guests' => $guests]) }}">
                                {{ $cuisine->name }} ({{ $cuisine->set_menus_count }})
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mb-5">
                @forelse ($setMenus as $menu)
                    <div class="max-w-80 inline-flex flex-col m-5">
                        <img class="w-80 h-48 object-cover rounded mb-2" src="{{ $menu->thumbnail }}" alt="{{ $menu->name }}">
                        <h3 class="mb-2">{{ $menu->name }}</h3>
                        <p class="text-xs mb-2">{{ $menu->description }}</p>
                        <p class="mb-2">£{{ max($menu->price_per_person * $guests, $menu->min_spend) }}</p>
                        <p class="text-xs">Price Per Person: £{{ $menu->price_per_person }}</p>
                        <p class="text-xs">Minimum Spend: £{{ $menu->min_spend }}</p>
                    </div>
                @empty
                    <p>No set menus available for this cuisine</p>
                @endforelse
            </div>
            
            <div class="pagination">
                {{ $setMenus->appends(['cuisine' => request('cuisine'), 'guests' => $guests])->links() }}
            </div>
        </div>
    </body>
</html>