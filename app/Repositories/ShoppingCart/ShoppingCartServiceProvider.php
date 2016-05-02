<?php

/**
 * ServiceProvider.php.
 *
 * Part of Overtrue\LaravelShoppingCart.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace App\Repositories\ShoppingCart;

use Illuminate\Support\ServiceProvider;

/**
 * Service provider for Laravel.
 */
class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->singleton('cart', function ($app) {
            return new Cart($app['session'], $app['events']);
        });
    }
}
