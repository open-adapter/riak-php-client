<?php

namespace OpenAdapter\Riak\Command;

use OpenAdapter\Riak\Command;
use OpenAdapter\Riak\CommandInterface;

/**
 * Pings Riak
 *
 * @author Christopher Mancini <cmancini at basho d0t com>
 */
class Ping extends Command implements CommandInterface
{
    public function __construct(Command\Builder\Ping $builder)
    {
        parent::__construct($builder);
    }

    public function getData()
    {
        return '';
    }

    public function getEncodedData()
    {
        return '';
    }
}
