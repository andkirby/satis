<?php
namespace Composer\Satis\Composer;

use AndKirby\Composer\MultiRepo\Repository\VcsNamespaceRepository;
use Composer\Config;
use Composer\EventDispatcher\EventDispatcher;
use Composer\IO\IOInterface;
use Composer\Repository\RepositoryManager;
use Composer\Util\RemoteFilesystem;

/**
 * Class Factory
 *
 * \Composer\Factory was extended to add custom repository class
 *
 * @package Composer\Satis\Composer
 */
class Factory extends \Composer\Factory
{
    /**
     * Add custom repositories
     *
     * @param RepositoryManager $rm
     * @return $this
     */
    public function addCustomRepositoryClasses(RepositoryManager $rm)
    {
        foreach (VcsNamespaceRepository::getTypes() as $type) {
            $rm->setRepositoryClass($type, VcsNamespaceRepository::class);
        }

        return $this;
    }

    /**
     * Added additional required VCS types
     * (e.g.: "vcs-namespace")
     *
     * @param  IOInterface      $io
     * @param  Config           $config
     * @param  EventDispatcher  $eventDispatcher
     * @param  RemoteFilesystem $rfs
     * @return RepositoryManager
     * @deprecated This method was used in old versions.
     */
    protected function createRepositoryManager(
        IOInterface $io,
        Config $config,
        EventDispatcher $eventDispatcher = null,
        RemoteFilesystem $rfs = null
    ) {
        $rm = parent::createRepositoryManager($io, $config, $eventDispatcher);

        $this->addCustomRepositoryClasses($rm);

        return $rm;
    }

    /**
     * Inject adding namespaced/custom repositories
     *
     * @param \Composer\IO\IOInterface               $io
     * @param \Composer\Repository\RepositoryManager $rm
     * @param string                                 $vendorDir
     */
    protected function addLocalRepository(IOInterface $io, RepositoryManager $rm, $vendorDir)
    {
        $this->addCustomRepositoryClasses($rm);

        parent::addLocalRepository($io, $rm, $vendorDir);
    }
}
