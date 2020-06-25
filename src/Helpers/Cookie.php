<?php
namespace App\Helpers;

use App\Exceptions\CookieNotSetException;

class Cookie
{
    /**
     * @param string $name The name of the cookie.
     * @param string $value the value of the cookie.
     * @param int    $exp [optional] <p>
     * This sets the expiration date. use integer to determine the seconds from now.
     * <h2 style="color: #cc0000;">Do not enter epoch value</h2>
     * </p>
     * @param string $path The path on the server in which the cookie will be available on.
     * @param string $domain The (sub)domain that the cookie is available to.
     *
     * @see https://www.php.net/manual/en/function.setcookie.php
     * @deprecated
     */
    public static function setCookie($name, $value, $exp = 86400, $path = '/', $domain = ''): void
    {
    	static::set(...func_get_args());
    }

	/**
	 * @param string $name The name of the cookie.
	 * @param string $value the value of the cookie.
	 * @param int    $exp [optional] <p>
	 * This sets the expiration date. use integer to determine the seconds from now.
	 * <h2 style="color: #cc0000;">Do not enter epoch value</h2>
	 * </p>
	 * @param string $path The path on the server in which the cookie will be available on.
	 * @param string $domain The (sub)domain that the cookie is available to.
	 *
	 * @see https://www.php.net/manual/en/function.setcookie.php
	 */
	public static function set($name, $value, $exp = 86400, $path = '/', $domain = ''): void
	{
		$time = ($exp && $exp > 0)? time() + $exp : 0;

		setcookie(
			$name,
			$value,
			[
				'expires' => $time,
				'path' => $path,
				'domain' => $domain,
				'secure' => true,
				'samesite' => 'Strict',
			]
		);
	}

    /**
     * Checks if a cookie exists
     *
     * @param string $cookie_name The name of the cookie.
     *
     * @return bool
     * @deprecated
     */
    public static function hasCookie($cookie_name): bool
    {
        return static::has($cookie_name);
    }

    public static function has($cookie_name): bool
    {
    	return isset($_COOKIE[$cookie_name]);
    }

    /**
     * Gets a cookie from the global $_COOKIE
     *
     * @param string $cookie_name The name of the cookie.
     *
     * @return mixed
     * @deprecated
     */
    public static function getCookie($cookie_name)
    {
        return static::get($cookie_name);
    }

	/**
	/**
	 * Gets a cookie from the global $_COOKIE
	 *
	 * @param string $cookie_name The name of the cookie.
	 *
	 * @return mixed
	 */
    public static function get($cookie_name)
    {
    	return $_COOKIE[$cookie_name];
    }

	/**
	 * @param $cookie_name
	 *
	 * @return void
	 */
    public static function delete($cookie_name)
    {
    	unset($_COOKIE[$cookie_name]);
    	static::set($cookie_name, null, -10);
    }
}
