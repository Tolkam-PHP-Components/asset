<?php declare(strict_types=1);

namespace Tolkam\Asset\Group;

use Tolkam\Asset\VersionStrategy\NoVersionStrategy;
use Tolkam\Asset\VersionStrategy\VersionStrategyInterface;

/**
 * Adds a base URI to versioned asset
 *
 * @package Tolkam\Asset\Group
 */
class UriGroup implements AssetGroupInterface
{
    use GroupTrait;
    
    /**
     * @var string
     */
    protected $uri;
    
    /**
     * @var null|VersionStrategyInterface
     */
    protected $versionStrategy;
    
    /**
     * @param string                        $uri
     * @param VersionStrategyInterface|null $versionStrategy
     */
    public function __construct(string $uri, VersionStrategyInterface $versionStrategy = null)
    {
        $sep = '/';
    
        $uri = rtrim(($uri ?: $sep), $sep) . $sep;
        
        if (!$this->isAbsoluteUrl($uri) && !$this->isAbsolutePath($uri)) {
            $uri = $sep . ltrim($uri, $sep);
        }
    
        $this->uri = $uri;
        $this->versionStrategy = $versionStrategy ?? new NoVersionStrategy();
    }
    
    /**
     * @inheritDoc
     */
    public function resolve(string $asset): string
    {
        $versioned = $this->versionStrategy->applyVersion($asset);
        $versioned = $this->removeExtraSlashes($versioned);
        
        // if absolute after versioning return as is
        if ($this->isAbsolutePath($versioned) || $this->isAbsoluteUrl($versioned)) {
            return $versioned;
        }
        
        return $this->uri . ltrim($versioned, '/');
    }
}
