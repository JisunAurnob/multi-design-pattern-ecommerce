<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Setting;
use App\Models\Wishlist;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(CartService::class, function () {
            return new CartService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $searchTerm = trim($searchTerm);
            $this->where(static function (Builder $query) use ($searchTerm, $attributes) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(Str::contains($attribute, '.'), static function (Builder $query) use ($searchTerm, $attribute) {
                        [$relationName, $relationAttribute] = explode('.', $attribute);
                        $query->orWhereHas($relationName, static function (Builder $query) use ($relationAttribute, $searchTerm) {
                            $query->where($relationAttribute, 'LIKE', "{$searchTerm}%");
                        });
                    }, static function (Builder $query) use ($attribute, $searchTerm) {
                        $query->orWhere($attribute, 'LIKE', "{$searchTerm}%");
                    });
                }
            });

            return $this;
        });

        if (!app()->runningInConsole()) {
            if (Schema::hasTable('settings')) {
                $settings = Setting::first();
                View::share('settings', $settings);
            }

            if (Schema::hasTable('categories')) {
                $categories = Category::where('status', 'active')->where('parent_id', null)->get();
                View::share('categories', $categories);
            }
        }
    }
}
