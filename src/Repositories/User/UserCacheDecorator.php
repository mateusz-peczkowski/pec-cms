<?php

namespace peczis\pecCms\Repositories\User;

use peczis\pecCms\Repositories\Contracts\UserRepositoryInterface;
use peczis\pecCms\Services\Cache\AbstractCacheDecorator;
use peczis\pecCms\Services\Contracts\CacheInterface;

class UserCacheDecorator extends AbstractCacheDecorator implements UserRepositoryInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected $user;

    protected $cache;

    public function __construct(UserRepositoryInterface $user, array $tags, CacheInterface $cache)
    {
        parent::__construct($cache, $user);

        $this->exchangeRate = $user;
        $this->cache->setTags($tags);
    }

}