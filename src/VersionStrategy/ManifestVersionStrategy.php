<?php declare(strict_types=1);

namespace Tolkam\Asset\VersionStrategy;

use InvalidArgumentException;
use RuntimeException;

class ManifestVersionStrategy implements VersionStrategyInterface
{
    /**
     * @var string
     */
    protected $manifestPath;
    
    /**
     * @var array
     */
    private $manifest;
    
    /**
     * @param string $manifestPath
     */
    public function __construct(string $manifestPath)
    {
        $this->manifestPath = $manifestPath;
    }
    
    /**
     * @inheritDoc
     */
    public function getVersion(string $asset)
    {
        return $this->applyVersion($asset);
    }
    
    /**
     * @inheritDoc
     */
    public function applyVersion(string $asset)
    {
        return $this->getFromManifest($asset) ?: $asset;
    }
    
    /**
     * Gets asset data from manifest file
     *
     * @param string $asset
     *
     * @return mixed|null
     */
    protected function getFromManifest(string $asset)
    {
        if (!$this->manifest) {
            if (!file_exists($this->manifestPath)) {
                throw new InvalidArgumentException(
                    sprintf('Manifest file %s does not exist', $this->manifestPath)
                );
            }
            
            $this->manifest = json_decode(file_get_contents($this->manifestPath), true);
            
            if (0 < json_last_error()) {
                throw new RuntimeException(sprintf(
                    'Failed to parse manifest file "%s" - %s',
                    $this->manifestPath,
                    json_last_error_msg()
                ));
            }
        }
        
        return $this->manifest[$asset] ?? null;
    }
}
