<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
	const STRING  = 'string';
	const INTEGER = 'integer';
	const INT     = 'integer';
	const FLOAT   = 'float';
	const BOOLEAN = 'boolean';
	const BOOL    = 'boolean';
	const ARRAY   = 'array';

	protected $primaryKey = 'name';

	protected $keyType = 'string';

	public $incrementing = false;

	public $timestamps = false;

	protected $fillable = ['value'];

	protected $dates = ['updated_at'];

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS & MUTATORS
	|--------------------------------------------------------------------------
	*/

	public function getValueAttribute($value)
	{
		switch ($this->type) {
			case self::STRING:
				return (string)$value;
			case self::INTEGER:
				return (int)$value;
			case self::FLOAT:
				return (float)$value;
			case self::BOOLEAN:
				return (bool)$value;
			case self::ARRAY:
				return json_decode($value);
			default:
				return $value;
		}
	}

	public function setValueAttribute($value)
	{
		if ($this->type === self::ARRAY) {
			$this->attributes['value'] = json_encode($value);
		} else {
			$this->attributes['value'] = $value;
		}
	}

	/*
	|--------------------------------------------------------------------------
	| GETTERS
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| LOGIC FUNCTIONS
	|--------------------------------------------------------------------------
	*/
}
