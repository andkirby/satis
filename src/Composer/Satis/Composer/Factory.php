<?php
namespace Composer\Satis\Composer;

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
        if (!isset($rm->getRepositories()['gitlab'])) {
            $rm->setRepositoryClass('gitlab', 'AndKirby\Composer\MultiRepo\Repository\GitLabRepository');
        }

        $rm->setRepositoryClass('gitlab-namespace', 'AndKirby\Composer\MultiRepo\Repository\GitLabNamespaceRepository');
        $rm->setRepositoryClass('vcs-namespace', 'AndKirby\Composer\MultiRepo\Repository\VcsNamespaceRepository');

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
     */
    protected function createRepositoryManager(IOInterface $io, Config $config, EventDispatcher $eventDispatcher = null,
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
