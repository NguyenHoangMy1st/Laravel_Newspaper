<?php
/**
 * Created by PhpStorm .
 * User: trungphuna .
 * Date: 3/7/21 .
 * Time: 12:17 PM .
 */

namespace App\Http\Middleware;


class CheckLoginAdmin
{
    public function handle($request, \Closure $next)
    {
        if (get_data_user('admins')) {
            return $next($request);
        }

        return redirect()->route('get.login.admin');
    }
}
