<?php namespace Imcorleone\LaravelFirstData\Facades;

use Illuminate\Support\Facades\Facade as IFacade;

class Facade extends IFacade
{
	protected static function getFacadeAccessor()
	{
		return 'firstdata';
	}
}