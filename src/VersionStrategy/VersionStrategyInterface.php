<?php declare(strict_types=1);

namespace Tolkam\Asset\VersionStrategy;

interface VersionStrategyInterface
{
    /**
     * Gets asset version
     *
     * @param string $asset
     *
     * @return mixed
     */
    public function getVersion(string $asset);
    
    /**
     * Gets asset with version applied
     *
     * @param string $asset
     *
     * @return mixed
     */
    public function applyVersion(string $asset);
}
