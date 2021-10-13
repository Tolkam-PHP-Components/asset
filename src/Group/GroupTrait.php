<?php declare(strict_types=1);

namespace Tolkam\Asset\Group;

trait GroupTrait
{
    /**
     * Checks if string is an absolute url
     *
     * @param string $str
     *
     * @return bool
     */
    protected function isAbsoluteUrl(string $str): bool
    {
        return false !== mb_strpos($str, '://') || '//' === mb_substr($str, 0, 2);
    }
    
    /**
     * Checks if string is an absolute path
     *
     * @param string $str
     *
     * @return bool
     */
    protected function isAbsolutePath(string $str): bool
    {
        return $str && $str[0] === '/';
    }
    
    /**
     * Removes extra slashes from url
     *
     * @param string $url
     *
     * @return string
     */
    protected function removeExtraSlashes(string $url): string
    {
        return preg_replace('/([^:])(\/{2,})/', '$1/', $url);
    }
}
