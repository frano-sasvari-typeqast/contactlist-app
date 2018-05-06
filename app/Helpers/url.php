<?php

if ( ! function_exists('urlWeb'))
{
    /**
     * Get full web url with path and query string
     *
     * @param  string  $path
     * @param  string|null  $locale
     * @param  array  $queries
     * @return string
     */
    function urlWeb($path = '', $locale = null, $queries = [])
    {
        $locale = $locale ?: trans()->getLocale();

        $queries = array_filter($queries, function ($value) {
            return ! is_null($value);
        });

        $path = $path.($queries ? '?'.http_build_query($queries) : '');

        return config('app.url_web.'.$locale).$path;
    }
}

if ( ! function_exists('urlApi'))
{
    /**
     * Get full app url with path and query string
     *
     * @param  string  $path
     * @param  string|null  $locale
     * @param  array  $queries
     * @return string
     */
    function urlApi($path = '', $locale = null, $queries = [])
    {
        $locale = $locale ?: trans()->getLocale();

        $queries = array_filter($queries, function ($value) {
            return ! is_null($value);
        });

        $path = $path.($queries ? '?'.http_build_query($queries) : '');

        return config('app.url_api.'.$locale).$path;
    }
}

if ( ! function_exists('cdnMix'))
{
    /**
     * Get full cdn url with filename from mix
     *
     * @param  string  $filename
     * @return string
     */
    function cdnMix($filename)
    {
        return cdn(ltrim(mix($filename, ''), '/'));
    }
}

if ( ! function_exists('cdn'))
{
    /**
     * Get full cdn url with filename
     *
     * @param  string  $filename
     * @return string
     */
    function cdn($filename = '')
    {
        return config('app.url_cdn').$filename;
    }
}

if ( ! function_exists('getUrlHostname'))
{
    /**
     * Get hostname of url (https://www.domainname.co.uk/url => domainname)
     *
     * @param  string  $url
     * @return string
     */
    function getUrlHostname($url)
    {
        $host = str_replace('www.', '', parse_url($url, PHP_URL_HOST));
        $hostname = explode('.', $host, 2);

        return $hostname[0];
    }
}
