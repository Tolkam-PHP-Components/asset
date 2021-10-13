<?php declare(strict_types=1);

namespace Tolkam\Asset;

use Tolkam\Asset\Group\AssetGroupInterface;

class AssetManager
{
    /**
     * @var AssetGroupInterface
     */
    protected $defaultGroup;
    
    /**
     * @var AssetGroupInterface[]
     */
    protected $groups = [];
    
    /**
     * @param AssetGroupInterface|null $defaultGroup
     */
    public function __construct(AssetGroupInterface $defaultGroup = null)
    {
        if ($defaultGroup) {
            $this->setDefaultGroup($defaultGroup);
        }
    }
    
    /**
     * Resolves asset url
     *
     * @param string      $asset
     * @param string|null $groupName
     *
     * @return string
     */
    public function resolve(string $asset, string $groupName = null): string
    {
        return $this->getGroup($groupName)->resolve($asset);
    }
    
    /**
     * Sets default group
     *
     * @param AssetGroupInterface $group
     *
     * @return AssetManager
     */
    public function setDefaultGroup(AssetGroupInterface $group): self
    {
        $this->defaultGroup = $group;
        
        return $this;
    }
    
    /**
     * Adds assets group
     *
     * @param string              $name
     * @param AssetGroupInterface $group
     *
     * @return AssetManager
     */
    public function addGroup(string $name, AssetGroupInterface $group): self
    {
        $this->groups[$name] = $group;
        
        return $this;
    }
    
    /**
     * Gets assets group by name
     *
     * @param string|null $name
     *
     * @return AssetGroupInterface
     * @throws ManagerException
     */
    public function getGroup(string $name = null): AssetGroupInterface
    {
        if ($name === null) {
            if (!$this->defaultGroup) {
                throw new ManagerException(
                    'Assets group name is empty but default group was never added'
                );
            }
            
            return $this->defaultGroup;
        }
        
        if (!$group = $this->groups[$name] ?? null) {
            throw new ManagerException(
                sprintf('Assets group %s was never added', $name)
            );
        }
        
        return $group;
    }
}
