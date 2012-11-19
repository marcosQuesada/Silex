<?php
Namespace Core;
use Silex\Application;

class Model
{
    protected $connection;

    public function __construct(Application $app)
    {
        $this->connection =  $app['DBAL'];
    }

    public function getCategory($id)
    {
        $sql = 'SELECT * FROM categorias where id = :id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function getAll($table)
    {
        return $this->connection->fetchAll('SELECT * FROM '.$table);
    }
}