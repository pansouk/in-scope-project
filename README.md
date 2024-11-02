# Senior Laravel Developer Assessment

## Requirements
* PHP 8.3
* SQLite

## Installation
* Clone
* Composer install
* Make migrations
* Seed Db (from factories or db seeder)

## Factories
```
App\Models\Company::factory(100)->create()
App\Models\Role::factory()->admin()->create()
App\Models\Role::factory()->user()->create()
App\Models\User::factory(100)->create()
```
