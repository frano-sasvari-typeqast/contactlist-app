<?php

if ( ! function_exists('cleanup'))
{
    /**
     * Cleanup string from extra empty spaces and html tags
     *
     * @param  string  $string
     * @return string
     */
    function cleanup($string)
    {
        return cleanupEmptySpaces(html_entity_decode(strip_tags($string)));
    }
}

if ( ! function_exists('cleanupEmptySpaces'))
{
    /**
     * Cleanup empty spaces and tags
     *
     * @param  string  $string
     * @return string
     */
    function cleanupEmptySpaces($string)
    {
        return trim(preg_replace('/\s+/S', ' ', $string));
    }
}

if ( ! function_exists('swap'))
{
    /**
     * Swap two variables
     *
     * @param  mixed  $x
     * @param  mixed  $y
     * @return void
     */
    function swap(&$x, &$y)
    {
        $tmp = $x;
        $x = $y;
        $y = $tmp;
    }
}

if ( ! function_exists('mb_ucfirst'))
{
    /**
     * Multi-byte ucfirst()
     *
     * @param  string  $string
     * @return string
     */
    function mb_ucfirst($string)
    {
        $first = mb_strtoupper(mb_substr($string, 0, 1));

        return $first.mb_substr($string, 1);
    }
}
