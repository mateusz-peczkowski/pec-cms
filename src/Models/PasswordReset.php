<?php

namespace peczis\pecCms\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = PEC_CMS_PREFIX . 'password_resets';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'token'
    ];

}

