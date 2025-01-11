# yhangry

Built with Laravel by Jas for yhangry

## Features

- Content: Fetch and store data using the set menus API
- Filters: Adjust the number of guests and sort by cuisine
- Tailwind: Styling using Tailwind CSS for a basic modern UI

## Installation

1. git clone https://github.com/x-jas/yhangry.git
2. cd yhangry
3. composer install
4. npm install
5. cp .env.example .env
6. php artisan migrate
7. php artisan app:fetch-set-menus
8. npm run dev
9. php artisan serve

## Structure

- Models: Cuisine and SetMenu
- Views: Index
- Controllers: SetMenuController
