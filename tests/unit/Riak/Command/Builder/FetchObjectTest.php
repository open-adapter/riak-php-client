<?php

namespace OpenAdapter\Riak\Tests\Riak\Command\Builder;

use OpenAdapter\Riak\Command;
use OpenAdapter\Riak\Tests\TestCase;

/**
 * Tests the configuration of Riak commands via the Command Builder class
 *
 * @author Christopher Mancini <cmancini at basho d0t com>
 */
class FetchObjectTest extends TestCase
{
    /**
     * Test command builder construct
     */
    public function testFetch()
    {
        // build an object
        $builder = new Command\Builder\FetchObject(static::$riak);
        $builder->buildLocation('some_key', 'some_bucket');
        $command = $builder->build();

        $this->assertInstanceOf('OpenAdapter\Riak\Command\DataObject\Fetch', $command);
        $this->assertInstanceOf('OpenAdapter\Riak\Bucket', $command->getBucket());
        $this->assertInstanceOf('OpenAdapter\Riak\Location', $command->getLocation());
        $this->assertEquals('some_bucket', $command->getBucket()->getName());
        $this->assertEquals('default', $command->getBucket()->getType());
        $this->assertEquals('some_key', $command->getLocation()->getKey());

        $builder->buildLocation('some_key', 'some_bucket', 'some_type');
        $command = $builder->build();

        $this->assertEquals('some_type', $command->getBucket()->getType());
    }

    /**
     * Tests validate properly verifies the Object is not there
     *
     * @expectedException \OpenAdapter\Riak\Command\Builder\Exception
     */
    public function testValidateLocation()
    {
        $builder = new Command\Builder\FetchObject(static::$riak);
        $builder->buildBucket('some_bucket');
        $builder->build();
    }
}
