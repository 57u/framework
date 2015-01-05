<?php

namespace mako\tests\unit\cache\stores;

use mako\cache\stores\Redis;

use \Mockery as m;

/**
 * @group unit
 */

class RedisTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * 
	 */

	public function tearDown()
	{
		m::close();
	}

	/**
	 * 
	 */

	public function getRedisClient()
	{
		return m::mock('mako\redis\Redis');
	}

	/**
	 * 
	 */

	public function testPut()
	{
		$client = $this->getRedisClient();

		$client->shouldReceive('set')->once()->with('foo', 123);

		$redis = new Redis($client);

		$redis->put('foo', 123);

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('set')->once()->with('foo', serialize('foo'));

		$redis = new Redis($client);

		$redis->put('foo', 'foo');

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('set')->once()->with('foo', 123);

		$client->shouldReceive('expire')->once()->with('foo', 3600);

		$redis = new Redis($client);

		$redis->put('foo', 123, 3600);

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('set')->once()->with('foo', serialize('foo'));

		$client->shouldReceive('expire')->once()->with('foo', 3600);

		$redis = new Redis($client);

		$redis->put('foo', 'foo', 3600);
	}

	/**
	 * 
	 */

	public function testHas()
	{
		$client = $this->getRedisClient();

		$client->shouldReceive('exists')->once()->with('foo')->andReturn(1);

		$redis = new Redis($client);

		$has = $redis->has('foo');

		$this->assertTrue($has);

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('exists')->once()->with('foo')->andReturn(0);

		$redis = new Redis($client);

		$has = $redis->has('foo');

		$this->assertFalse($has);
	}

	/**
	 * 
	 */

	public function testGet()
	{
		$client = $this->getRedisClient();

		$client->shouldReceive('get')->once()->with('foo')->andReturn(123);

		$redis = new Redis($client);

		$cached = $redis->get('foo');

		$this->assertEquals(123, $cached);

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('get')->once()->with('foo')->andReturn(serialize('foo'));

		$redis = new Redis($client);

		$cached = $redis->get('foo');

		$this->assertEquals('foo', $cached);
	}

	/**
	 * 
	 */

	public function testRemove()
	{
		$client = $this->getRedisClient();

		$client->shouldReceive('del')->once()->with('foo')->andReturn(1);

		$redis = new Redis($client);

		$removed = $redis->remove('foo');

		$this->assertTrue($removed);

		//

		$client = $this->getRedisClient();

		$client->shouldReceive('del')->once()->with('foo')->andReturn(0);

		$redis = new Redis($client);

		$removed = $redis->remove('foo');

		$this->assertFalse($removed);
	}

	/**
	 * 
	 */

	public function testClear()
	{
		$client = $this->getRedisClient();

		$client->shouldReceive('flushdb')->once();

		$redis = new Redis($client);

		$redis->clear();
	}
}