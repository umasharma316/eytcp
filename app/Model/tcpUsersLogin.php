<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tcpUsersLogin extends Model
{
	protected $connection = 'mysql';
    protected $table = 'tcp.users';
}
