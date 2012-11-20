<?php
Namespace Core;
use Doctrine\DBAL\Connection;

class Model
{
    protected $connection;

    public function __construct(Connection $db)
    {
        $this->connection =  $db;
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
        try
        {
            return $this->connection->fetchAll('SELECT * FROM '.$table);
        }catch(\Exception $e)
        {
            throw new \Exception("Posts not found.<br>".$e->getMessage());
        }
    }
}