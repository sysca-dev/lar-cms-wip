<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Thetispro\Setting\Facades\Setting;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // @todo Grab settings information from the database.

      // General
      Setting::set('title', 'EXT Gaming');
      Setting::set('registration', true);
      Setting::set('description', 'EXT Gaming is a community of awesome people, looking to have fun playing games');
      Setting::set('timezone', 'UTC');

      // Social
      Setting::set('social', [
        'twitch' => 'https://www.twitch.tv/gamingext',
        'facebook' => 'http://www.facebook.com/groups/extgcommunity/',
        'twitter' => 'https://twitter.com/extensiongaming',
        'steam' => 'http://steamcommunity.com/groups/extgcommunity',
        'youtube' => null
      ]);

      // Donations
      Setting::set('donation', [
        'description' => 'Help us keep the community going!',
        'link' => 'https://www.clanwarz.com/payments/cpdonate.php?cid=19386',
        'goal' => 30,
        'current' => 45
      ]);

      User::created(function ($user){
        $user->profile()->create([]);
        return true;
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
