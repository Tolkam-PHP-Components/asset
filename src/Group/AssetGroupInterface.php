<?php declare(strict_types=1);

namespace Tolkam\Asset\Group;

interface AssetGroupInterface
{
    /**
     * Resolves asset url
     *
     * @param string $asset
     *
     * @return string
     */
    public function resolve(string $asset): string;
}
