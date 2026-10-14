<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CacheTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cache')->delete();
        
        \DB::table('cache')->insert(array (
            0 => 
            array (
                'key' => 'laravel-cache-a4424d864e0e42722342e0d5347c3321',
                'value' => 'i:1;',
                'expiration' => 1791879947,
            ),
            1 => 
            array (
                'key' => 'laravel-cache-a4424d864e0e42722342e0d5347c3321:timer',
                'value' => 'i:1791879947;',
                'expiration' => 1791879947,
            ),
            2 => 
            array (
                'key' => 'laravel-cache-d1c5306ce2f458db012f8635f5fbcbed',
                'value' => 'i:1;',
                'expiration' => 1791880346,
            ),
            3 => 
            array (
                'key' => 'laravel-cache-d1c5306ce2f458db012f8635f5fbcbed:timer',
                'value' => 'i:1791880346;',
                'expiration' => 1791880346,
            ),
            4 => 
            array (
                'key' => 'laravel-cache-spatie.permission.cache',
                'value' => 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:16:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:17:"categories.create";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:18:"categories.destroy";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:3;s:1:"b";s:15:"categories.edit";s:1:"c";s:3:"web";}i:3;a:3:{s:1:"a";i:4;s:1:"b";s:16:"categories.index";s:1:"c";s:3:"web";}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:27:"quatation-log-books.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:24:"quatation-log-books.edit";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:25:"quatation-log-books.index";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:26:"quatation-log-books.create";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:12:"roles.create";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:13:"roles.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:10:"roles.edit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:11:"roles.index";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:12:"users.create";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:13:"users.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:10:"users.edit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:11:"users.index";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}}s:5:"roles";a:2:{i:0;a:3:{s:1:"a";i:2;s:1:"b";s:8:"Chairman";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:6;s:1:"b";s:8:"Employee";s:1:"c";s:3:"web";}}}',
                'expiration' => 1791966687,
            ),
            5 => 
            array (
                'key' => 'unicorn-group-cache-356a192b7913b04c54574d18c28d46e6395428ab',
                'value' => 'i:1;',
                'expiration' => 1791952909,
            ),
            6 => 
            array (
                'key' => 'unicorn-group-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer',
                'value' => 'i:1791952909;',
                'expiration' => 1791952909,
            ),
            7 => 
            array (
                'key' => 'unicorn-group-cache-boost.roster.scan',
                'value' => 'a:2:{s:6:"roster";O:21:"Laravel\\Roster\\Roster":3:{s:13:"' . "\0" . '*' . "\0" . 'approaches";O:29:"Illuminate\\Support\\Collection":2:{s:8:"' . "\0" . '*' . "\0" . 'items";a:1:{i:0;O:23:"Laravel\\Roster\\Approach":1:{s:11:"' . "\0" . '*' . "\0" . 'approach";E:38:"Laravel\\Roster\\Enums\\Approaches:ACTION";}}s:28:"' . "\0" . '*' . "\0" . 'escapeWhenCastingToString";b:0;}s:11:"' . "\0" . '*' . "\0" . 'packages";O:32:"Laravel\\Roster\\PackageCollection":2:{s:8:"' . "\0" . '*' . "\0" . 'items";a:11:{i:0;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:0;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:7:"v1.41.0";s:10:"' . "\0" . '*' . "\0" . 'package";E:37:"Laravel\\Roster\\Enums\\Packages:FORTIFY";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:15:"laravel/fortify";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"1.41.0";s:6:"' . "\0" . '*' . "\0" . 'dev";b:0;}i:1;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:5:"^12.0";s:10:"' . "\0" . '*' . "\0" . 'package";E:37:"Laravel\\Roster\\Enums\\Packages:LARAVEL";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:17:"laravel/framework";s:10:"' . "\0" . '*' . "\0" . 'version";s:7:"12.70.0";s:6:"' . "\0" . '*' . "\0" . 'dev";b:0;}i:2;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:0;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:7:"v0.3.26";s:10:"' . "\0" . '*' . "\0" . 'package";E:37:"Laravel\\Roster\\Enums\\Packages:PROMPTS";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:15:"laravel/prompts";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"0.3.26";s:6:"' . "\0" . '*' . "\0" . 'dev";b:0;}i:3;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:4:"^4.0";s:10:"' . "\0" . '*' . "\0" . 'package";E:37:"Laravel\\Roster\\Enums\\Packages:SANCTUM";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:15:"laravel/sanctum";s:10:"' . "\0" . '*' . "\0" . 'version";s:5:"4.3.3";s:6:"' . "\0" . '*' . "\0" . 'dev";b:0;}i:4;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:6:"^3.6.4";s:10:"' . "\0" . '*' . "\0" . 'package";E:38:"Laravel\\Roster\\Enums\\Packages:LIVEWIRE";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:17:"livewire/livewire";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"3.8.10";s:6:"' . "\0" . '*' . "\0" . 'dev";b:0;}i:5;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:0;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:6:"v0.5.9";s:10:"' . "\0" . '*' . "\0" . 'package";E:33:"Laravel\\Roster\\Enums\\Packages:MCP";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:11:"laravel/mcp";s:10:"' . "\0" . '*' . "\0" . 'version";s:5:"0.5.9";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}i:6;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:5:"^1.24";s:10:"' . "\0" . '*' . "\0" . 'package";E:34:"Laravel\\Roster\\Enums\\Packages:PINT";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:12:"laravel/pint";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"1.32.1";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}i:7;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:5:"^1.41";s:10:"' . "\0" . '*' . "\0" . 'package";E:34:"Laravel\\Roster\\Enums\\Packages:SAIL";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:12:"laravel/sail";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"1.69.0";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}i:8;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:1;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:4:"^3.8";s:10:"' . "\0" . '*' . "\0" . 'package";E:34:"Laravel\\Roster\\Enums\\Packages:PEST";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:12:"pestphp/pest";s:10:"' . "\0" . '*' . "\0" . 'version";s:5:"3.8.7";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}i:9;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:0;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:7:"11.5.56";s:10:"' . "\0" . '*' . "\0" . 'package";E:37:"Laravel\\Roster\\Enums\\Packages:PHPUNIT";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:15:"phpunit/phpunit";s:10:"' . "\0" . '*' . "\0" . 'version";s:7:"11.5.56";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}i:10;O:22:"Laravel\\Roster\\Package":6:{s:9:"' . "\0" . '*' . "\0" . 'direct";b:0;s:13:"' . "\0" . '*' . "\0" . 'constraint";s:0:"";s:10:"' . "\0" . '*' . "\0" . 'package";E:41:"Laravel\\Roster\\Enums\\Packages:TAILWINDCSS";s:14:"' . "\0" . '*' . "\0" . 'packageName";s:11:"tailwindcss";s:10:"' . "\0" . '*' . "\0" . 'version";s:6:"3.4.18";s:6:"' . "\0" . '*' . "\0" . 'dev";b:1;}}s:28:"' . "\0" . '*' . "\0" . 'escapeWhenCastingToString";b:0;}s:21:"' . "\0" . '*' . "\0" . 'nodePackageManager";E:43:"Laravel\\Roster\\Enums\\NodePackageManager:NPM";}s:9:"timestamp";i:1791956600;}',
                'expiration' => 1792043000,
            ),
            8 => 
            array (
                'key' => 'unicorn-group-cache-d1c5306ce2f458db012f8635f5fbcbed',
                'value' => 'i:1;',
                'expiration' => 1791889551,
            ),
            9 => 
            array (
                'key' => 'unicorn-group-cache-d1c5306ce2f458db012f8635f5fbcbed:timer',
                'value' => 'i:1791889551;',
                'expiration' => 1791889551,
            ),
            10 => 
            array (
                'key' => 'unicorn-group-cache-fb6f3f3e6cd1eef80b0cb863c26af4f5',
                'value' => 'i:1;',
                'expiration' => 1791951108,
            ),
            11 => 
            array (
                'key' => 'unicorn-group-cache-fb6f3f3e6cd1eef80b0cb863c26af4f5:timer',
                'value' => 'i:1791951108;',
                'expiration' => 1791951108,
            ),
            12 => 
            array (
                'key' => 'unicorn-group-cache-spatie.permission.cache',
                'value' => 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:16:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:17:"categories.create";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:18:"categories.destroy";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:3;s:1:"b";s:15:"categories.edit";s:1:"c";s:3:"web";}i:3;a:3:{s:1:"a";i:4;s:1:"b";s:16:"categories.index";s:1:"c";s:3:"web";}i:4;a:4:{s:1:"a";i:5;s:1:"b";s:27:"quatation-log-books.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:5;a:4:{s:1:"a";i:6;s:1:"b";s:24:"quatation-log-books.edit";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:6;a:4:{s:1:"a";i:7;s:1:"b";s:25:"quatation-log-books.index";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:7;a:4:{s:1:"a";i:8;s:1:"b";s:26:"quatation-log-books.create";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:2;i:1;i:6;}}i:8;a:4:{s:1:"a";i:9;s:1:"b";s:12:"roles.create";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:9;a:4:{s:1:"a";i:10;s:1:"b";s:13:"roles.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:10;a:4:{s:1:"a";i:11;s:1:"b";s:10:"roles.edit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:11;a:4:{s:1:"a";i:12;s:1:"b";s:11:"roles.index";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:12;a:4:{s:1:"a";i:13;s:1:"b";s:12:"users.create";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:13;a:4:{s:1:"a";i:14;s:1:"b";s:13:"users.destroy";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:14;a:4:{s:1:"a";i:15;s:1:"b";s:10:"users.edit";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}i:15;a:4:{s:1:"a";i:16;s:1:"b";s:11:"users.index";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:2;}}}s:5:"roles";a:2:{i:0;a:3:{s:1:"a";i:2;s:1:"b";s:8:"Chairman";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:6;s:1:"b";s:8:"Employee";s:1:"c";s:3:"web";}}}',
                'expiration' => 1791967427,
            ),
        ));
        
        
    }
}