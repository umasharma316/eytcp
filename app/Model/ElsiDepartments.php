<?php namespace App\Model;

use Eloquent;

class ElsiDepartments extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $connection = 'mysql_1';
	protected $table = 'elsi_departments';
}