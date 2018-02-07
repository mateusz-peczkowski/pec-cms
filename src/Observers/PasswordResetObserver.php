<?php

namespace peczis\pecCms\Observers;

use peczis\pecCms\Models\PasswordReset;

class PasswordResetObserver
{

    /**
     * Listen to the PasswordReset created event
     *
     * @param PasswordReset
     * @return void
     */
    public function created(PasswordReset $passwordReset)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the PasswordReset created event
     *
     * @param PasswordReset
     * @return void
     */
    public function updated(PasswordReset $passwordReset)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the PasswordReset created event
     *
     * @param PasswordReset
     * @return void
     */
    public function saved(PasswordReset $passwordReset)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the PasswordReset created event
     *
     * @param PasswordReset
     * @return void
     */
    public function deleted(PasswordReset $passwordReset)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface');
        $cache->flush();
        return;
    }

    /**
     * Listen to the PasswordReset created event
     *
     * @param PasswordReset
     * @return void
     */
    public function restored(PasswordReset $passwordReset)
    {
        $cache = resolve('peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface');
        $cache->flush();
        return;
    }

}