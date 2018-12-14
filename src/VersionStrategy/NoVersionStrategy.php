<?php declare(strict_types=1);

namespace Tolkam\Asset\VersionStrategy;

class NoVersionStrategy implements VersionStrategyInterface
{
    /**
     * @inheritDoc
     */
    public function getVersion(string $asset)
    {
        return '';
    }
    
    /**
     * @inheritDoc
     */
    public function applyVersion(string $asset)
    {
        return $asset;
    }
}
