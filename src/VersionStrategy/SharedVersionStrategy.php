<?php declare(strict_types=1);

namespace Tolkam\Asset\VersionStrategy;

class SharedVersionStrategy implements VersionStrategyInterface
{
    /**
     * @var string
     */
    protected $version;
    
    /**
     * @var null|string
     */
    protected $format;
    
    /**
     * @param string      $version
     * @param string|null $format
     */
    public function __construct(string $version, string $format = null)
    {
        $this->version = $version;
        $this->format = $format ?: '%1$s?%2$s';
    }
    
    /**
     * @inheritDoc
     */
    public function getVersion(string $asset)
    {
        return $this->version;
    }
    
    /**
     * @inheritDoc
     */
    public function applyVersion(string $asset)
    {
        return sprintf($this->format, $asset, $this->getVersion($asset));
    }
}
