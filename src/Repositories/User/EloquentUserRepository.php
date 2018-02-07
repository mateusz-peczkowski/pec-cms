<?php

namespace peczis\pecCms\Repositories\User;

use peczis\pecCms\Repositories\Contracts\UserRepositoryInterface;
use peczis\pecCms\Repositories\Eloquent\AbstractRepository;

class EloquentUserRepository extends AbstractRepository implements UserRepositoryInterface
{

    /*
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'peczis\pecCms\Models\User';
    }

}