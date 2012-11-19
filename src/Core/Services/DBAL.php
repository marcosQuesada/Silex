<?php
Namespace Core\Services;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class DBAL
{
    protected $connection;

    public function __construct(array $config)
    {
        $config = $config['parameters'];
        $connectionParams = array(
            'dbname' => $config['database_name'],
            'user' => $config['database_user'],
            'password' => $config['database_password'],
            'host' => $config['database_host'],
            'driver' => $config['database_driver']
        );
        $config = new Configuration();
        $this->connection = DriverManager::getConnection($connectionParams, $config);

    }

    public function getConnection()
    {
        return $this->connection;
    }
}