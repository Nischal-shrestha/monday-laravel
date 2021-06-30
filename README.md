# Monday Laravel

This package is used to query the [monday.com](https://www.monday.com)'s GraphQL api.

## Usage

Please follow the steps below to install and use this package.

##### 1. Require the package

```bash
composer require nishstha/monday-laravel
```

##### 2. Publish the config file

```bash
php artisan vendor:publish --provider="Nishstha\Monday\MondayServiceProvider"
```

##### 3. Setup your API Keys

You will need to setup your monday api keys in `config/monday.php`.

```php
return [
  'api_url' => env('MONDAY_API_URL', 'https://api.monday.com/v2'),
  'api_key' => env('MONDAY_API_KEY', 'your_key_here'),
];
```

##### 4. All done

Now that we are done with that. We can call the Monday API. See the example below.

Make sure to import the facade at the top

```php
use Nishstha\Monday\Facades\Monday;
```

then we can call the api using

```php
$response = Monday::call($query);
```

The response returned is a of type `\GuzzleHttp\Psr7\Response` object or `null`.

The query can be easily structed :

```php
$query = <<<GQL
  query{
      boards(ids: $boardId){
        groups{
          id,
          title
        }
      }
    }
GQL;

// passing true as the second parameter returns the data object
$response = Monday::call($query,true);
$data = $response->boards->groups;
```
