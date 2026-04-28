<?php

namespace SilverStripe\GarbageCollector\Processors;

use Override;
use Exception;
use SilverStripe\GarbageCollector\Models\RawSQL;
use SilverStripe\ORM\DB;

class RawSQLProcessor extends AbstractProcessor
{

    public function __construct(/**
     * Query to process
     */
    private readonly ?RawSQL $query = null, string $name = '')
    {
        parent::__construct($name);
    }

    /**
     * Get internal query
     *
     * @return RawSQL
     * @throws Exception
     */
    protected function getQuery(): RawSQL
    {
        if (!$this->query instanceof RawSQL) {
            throw new Exception(static::class . ' requires a RawSQL provided via its constructor.');
        }

        return $this->query;
    }

    /**
     * Execute query
     *
     * @return int Always 1 as its a single SQL query being executed
     * @throws Exception
     */
    public function process(): int
    {
        DB::query($this->getQuery()->sql());
        return 1;
    }

    /**
     * Get name of processor
     *
     * @return string Name of processor
     */
    #[Override]
    public function getName(): string
    {
        $name = parent::getName();
        if ($name !== '' && $name !== '0') {
            return $name;
        }

        return 'RawSQLProcessor';
    }

    /**
     * Classes the implement this class can use this processor
     */
    public function getImplementorClass(): string
    {
        return RawSQL::class;
    }
}
