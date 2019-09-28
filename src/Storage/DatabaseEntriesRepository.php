<?php

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use EntriesRepository as Contract;

class DatabaseEntriesRepository implements Contract
{
    /**
     * The database connection name that should be used.
     *
     * @var string
     */
    protected $connection;

    /**
     * Create a new database repository.
     *
     * @param string $connection
     * @return void
     */
    public function __construct(string $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Get a query builder instance for the given table.
     *
     * @param string $table
     * @return Builder
     */
    protected function table($table)
    {
        return DB::connection($this->connection)->table($table);
    }
}