<?php

namespace core\control\database\driver;

use core\control\database\DatabaseException;
use core\control\database\DatabaseResult;

class PostgreSQL implements DatabaseDriver{

    private $connection;
    private $affected = 0;

    public function __construct(array $connInf){
        if(!array_key_exists('port', $connInf) || empty($connInf['port'])) $connInf['port'] = 5432;
        $this->connection = \pg_connect("host={$connInf['host']} port={$connInf['port']} dbname={$connInf['dbName']} user={$connInf['user']} password={$connInf['password']}");
        if(!$this->connection) throw new DatabaseException("Can't establish a connection to PostgreSQL.");
    }

    /**
     * Execute a SQL query
     * @param string $sql SQL query string
     * @return bool|DatabaseResult
     * @throws DatabaseException
     */
    public function query($sql){
        try{
            if($result = \pg_query($this->connection, $sql)){
                $this->affected = \pg_affected_rows($result);
                $tmp = new DatabaseResult();
                $tmp->setRows(\pg_fetch_all($result));
                \pg_free_result($result);
                return $tmp;
            }
            else throw new \ErrorException("There's an error in your SQL statement.");
        }catch(\ErrorException $e){
            $db = debug_backtrace()[0];
            throw new DatabaseException($e->getMessage(), $e->getCode(), 0, $db['file'], $db['line']);
        }
    }

    /**
     * Selects the Database
     * @param string $dbName Name of the database
     * @return bool
     * @throws DatabaseException
     */
    public function selectDatabase($dbName){
        throw new DatabaseException("Operation not supported.");
    }

    /**
     * Starts a transaction
     * @return void
     * @throws DatabaseException
     */
    public function startTransaction(){
        if(!$this->query("BEGIN")) throw new DatabaseException("Could not start transaction.");
    }

    /**
     * Closes a transaction
     * @return void
     * @throws DatabaseException
     */
    public function closeTransaction(){
        if(!$this->query("END")) throw new DatabaseException("Could not end transaction.");
    }

    /**
     * Commit the changes to the Database
     * @return bool
     * @throws DatabaseException
     */
    public function commit(){
        if(!$this->query("COMMIT")) throw new DatabaseException("Transaction commit failed.");
    }

    /**
     * Do a rollback
     * @return bool
     * @throws DatabaseException
     */
    public function rollback(){
        if(!$this->query("ROLLBACK")) throw new DatabaseException("Transaction rollback failed.");
    }

    /**
     * Return the number of affected rows
     * @return int
     */
    public function affectedRows(){
        return $this->affected;
    }

    /**
     * Closes the connection to the database
     * @return bool
     */
    public function close(){
        return \pg_close($this->connection);
    }
}