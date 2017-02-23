<?php
namespace dzegarra\tracy;

class mysqli extends \mysqli
{
    /**
     * Logged queries.
     * @var array
     */
    protected $log = [];

    /**
     * Relay all calls.
     *
     * @param string $name      The method name to call.
     * @param array  $arguments The arguments for the call.
     *
     * @return mixed The call results.
     */
    public function __call($name, array $arguments)
    {
        return call_user_func_array(
            array($this, $name),
            $arguments
        );
    }

    /**
     * @see \mysqli::query
     */
    public function query($query, $resultmode = MYSQLI_STORE_RESULT)
    {
        $start = microtime(true);
        $result = parent::query($query, $resultmode);
        $this->addLog($query, microtime(true) - $start);
        return $result;
    }

    /**
     * Add query to logged queries.
     * @param string $query
     */
    public function addLog($query, $time)
    {
        $entry = [
            'statement' => $query,
            'time' => $time
        ];
        array_push($this->log, $entry);
    }

    /**
     * Return logged queries.
     * @return array Logged queries
     */
    public function getLog()
    {
        return $this->log;
    }
}
