<?php declare(strict_types=1);

namespace Tolkam\Asset\VersionStrategy;

use InvalidArgumentException;

class ModificationVersionStrategy implements VersionStrategyInterface
{
    /**
     * @var string
     */
    protected $version;
    
    /**
     * @var string
     */
    protected $rootPath;
    
    /**
     * @var null|string
     */
    protected $format;
    
    /**
     * @param string      $rootPath
     * @param string|null $format
     */
    public function __construct(string $rootPath, string $format = null)
    {
        $this->rootPath = rtrim($rootPath, '/') . '/';
        $this->format = $format ?: '%1$s?%2$s';
    }
    
    /**
     * @inheritDoc
     */
    public function getVersion(string $asset)
    {
        $assetPath = $this->rootPath . $asset;
        
        if (!file_exists($assetPath)) {
            throw new InvalidArgumentException(sprintf('Asset file %s does not exist', $assetPath));
        }
        
        return filemtime($assetPath);
    }
    
    /**
     * @inheritDoc
     */
    public function applyVersion(string $asset)
    {
        return sprintf($this->format, $asset, $this->getVersion($asset));
    }
}
