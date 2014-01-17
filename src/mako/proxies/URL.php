<?php

namespace mako\proxies;

use \mako\core\Application;

/**
 * URL builder proxy.
 *
 * @author     Frederic G. Østby
 * @copyright  (c) 2008-2013 Frederic G. Østby
 * @license    http://www.makoframework.com/license
 */

class URL extends \mako\proxies\Proxy
{
	/**
	 * Returns instance of the class we're proxying.
	 * 
	 * @access  protected
	 * @return  \mako\http\routing\URLBuilder
	 */

	protected static function instance()
	{
		return Application::instance()->get('urlbuilder');
	}
}

/** -------------------- End of file -------------------- **/