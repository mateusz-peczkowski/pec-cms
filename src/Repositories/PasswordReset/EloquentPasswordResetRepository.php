<?php

namespace peczis\pecCms\Repositories\PasswordReset;

use peczis\pecCms\Repositories\Contracts\PasswordResetRepositoryInterface;
use peczis\pecCms\Repositories\Eloquent\AbstractRepository;

class EloquentPasswordResetRepository extends AbstractRepository implements PasswordResetRepositoryInterface
{

    /*
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'peczis\pecCms\Models\PasswordReset';
    }

}