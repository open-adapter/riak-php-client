<?php

namespace OpenAdapter\Riak\Tests;

use OpenAdapter\Riak\Command;

/**
 * Class PreflistTest
 *
 * Functional tests related to Riak Preference lists
 *
 * @author Christopher Mancini <cmancini at basho d0t com>
 */
class PreflistTest extends TestCase
{
    public function testFetch()
    {
        // build a store object command, get the location of the newly minted object
        $location = (new Command\Builder\StoreObject(static::$riak))
            ->buildObject('some_data')
            ->buildBucket('users')
            ->build()
            ->execute()
            ->getLocation();

        // build a fetch command
        $command = (new Command\Builder\FetchPreflist(static::$riak))
            ->atLocation($location)
            ->build();

        try {
            $response = $command->execute();
            if ($response->getCode() == 400) {
                $this->markTestSkipped('preflists are not supported');
            } else {
                $this->assertEquals(200, $response->getCode());
                $this->assertNotEmpty($response->getDataObject()->getData()->preflist);
                $this->assertObjectHasAttribute("partition", $response->getDataObject()->getData()->preflist[0]);
                $this->assertObjectHasAttribute("node", $response->getDataObject()->getData()->preflist[0]);
                $this->assertObjectHasAttribute("primary", $response->getDataObject()->getData()->preflist[0]);
            }
        } catch (\OpenAdapter\Riak\Exception $e) {
            $this->markTestSkipped('preflists are not supported');
        }
    }
}
