<?php
namespace core\control\database;

/**
 * DatabaseDriver interface
 * @package core\control\database
 */
interface DatabaseDriver{
    /**
     * Configures the Database Driver
     * @param array $connInf Server configuration data
     * @return DatabaseDriver
     */
    public function __construct(array $connInf);
    
    /**
     * Execute a SQL query
     * @param string $sql SQL query string
     * @return bool|DatabaseResult
     * @throws DatabaseError
     */
    public function query($sql);
    
    /**
     * Selects the Database
     * @param $dbName Name of the database
     * @return bool
     * @throws DatabaseError
     */
    public function selectDatabase($dbName);
    
    /**
     * Starts a transaction
     * @return void
     */
    public function startTransaction();
    
    /**
     * Closes a transaction
     * @return void
     */
    public function closeTransaction();
    
    /**
     * Commit the changes to the Database
     * @return bool
     */
    public function commit();
    
    /**
     * Do a rollback
     * @return bool
     */
    public function rollback();
    
    /**
     * Return the number of affected rows
     * @return int
     */
    public function affectedRows();
}