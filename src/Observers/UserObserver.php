<?php

namespace peczis\pecCms\Observers;

use peczis\pecCms\Models\User;

class UserObserver
{

    /**
     * Listen to the User created event
     *
     * @param User
     * @return void
     */
    public function created(User $user)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the User created event
     *
     * @param User
     * @return void
     */
    public function updated(User $user)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the User created event
     *
     * @param User
     * @return void
     */
    public function saved(User $user)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the User created event
     *
     * @param User
     * @return void
     */
    public function deleted(User $user)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the User created event
     *
     * @param User
     * @return void
     */
    public function restored(User $user)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\UserRepositoryInterface');
        $cache->flush();
        return;
    }

}