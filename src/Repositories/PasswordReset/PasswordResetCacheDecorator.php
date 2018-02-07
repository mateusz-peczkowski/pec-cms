<?php

namespace peczis\pecCms\Repositories\PasswordReset;

use peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface;
use peczis\pecCms\Services\Cache\AbstractCacheDecorator;
use peczis\pecCms\Services\Contracts\CacheInterface;

class PasswordResetCacheDecorator extends AbstractCacheDecorator implements PasswordResetRepositoryInterface
{
    /**
     * @var PasswordResetRepositoryInterface
     */
    protected $user;

    protected $cache;

    public function __construct(PasswordResetRepositoryInterface $user, array $tags, CacheInterface $cache)
    {
        parent::__construct($cache, $user);

        $this->exchangeRate = $user;
        $this->cache->setTags($tags);
    }

}