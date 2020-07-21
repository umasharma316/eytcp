<?php namespace App\Model;

use Eloquent;

class CollegeDetails extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $connection = 'mysql_1';
	protected $table = 'elsi_college_dtls';
}