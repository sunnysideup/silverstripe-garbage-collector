<?php

declare(strict_types=1);

namespace SilverStripe\GarbageCollector\Models;

class RawSQL
{
    public function __construct(private $query)
    {
    }

    public function setQuery($query)
    {
        $this->query = $query;
    }

    public function getQuery()
    {
        return $this->query;
    }

    public function sql()
    {
        return $this->getQuery();
    }
}
