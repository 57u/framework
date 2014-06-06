<?php

/**
 * @copyright  Frederic G. Østby
 * @license    http://www.makoframework.com/license
 */

namespace mako\application\services;

use \mako\utility\Humanizer;

/**
 * Humanizer service.
 *
 * @author  Frederic G. Østby
 */

class HumanizerService extends \mako\application\services\Service
{
	/**
	 * Registers the service.
	 * 
	 * @access  public
	 */

	public function register()
	{
		$this->container->registerSingleton(['mako\utility\Humanizer', 'humanizer'], function($container)
		{
			return new Humanizer($container->get('i18n'));
		});
	}
}