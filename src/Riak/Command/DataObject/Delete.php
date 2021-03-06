<?php

namespace OpenAdapter\Riak\Command\DataObject;

use OpenAdapter\Riak\Command;
use OpenAdapter\Riak\CommandInterface;

/**
 * Used to remove an object from Riak
 *
 * @author Christopher Mancini <cmancini at basho d0t com>
 */
class Delete extends Command\DataObject implements CommandInterface
{
    protected $method = 'DELETE';

    public function __construct(Command\Builder\DeleteObject $builder)
    {
        parent::__construct($builder);

        $this->bucket = $builder->getBucket();
        $this->location = $builder->getLocation();
    }
}
