<?php

namespace Nishstha\Monday;

use Illuminate\Support\ServiceProvider;

class MondayServiceProvider extends ServiceProvider
{
  public function boot()
  {
    $this->publishes([
      __DIR__ . '/../config/monday.php' => config_path('monday.php'),
    ]);
  }

  public function register()
  {
    $this->app->bind('monday', function ($app) {
      return new Monday();
    });
  }
}
