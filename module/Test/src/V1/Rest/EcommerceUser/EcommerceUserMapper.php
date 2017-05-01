<?php
namespace Test\V1\Rest\EcommerceUser;

use Zend\Db\Sql\Select;
use Zend\Db\Sql\Delete;
use Zend\Db\Adapter\Adapter;
use SA\Adapter\LowercaseDbSelect;

class EcommerceUserMapper
{
    protected $db;
    protected $table;

    public function __construct(Adapter $db)
    {
        $this->db = $db;
        $this->table = new \Zend\Db\Sql\TableIdentifier('ECOMMERCE_USERS', 'APIGILITY');
    }

    public function fetchAll()
    {
        $select = new Select($this->table);
        $paginatorAdapter = new LowercaseDbSelect($select, $this->db);
        $collection = new EcommerceUserCollection($paginatorAdapter);
        return $collection;
    }

    public function fetchOne($userId)
    {
        $sql = 'SELECT * FROM APIGILITY.ECOMMERCE_USERS WHERE id = ?';
        $resultset = $this->db->query($sql, array($userId));
        $data = $resultset->toArray();
        if (!$data) {
            return false;
        }

        $entity = new EcommerceUserEntity();
        $entity->populate($data[0]);
        return $entity;
    }

    public function save($data, $id = 0)
    {
        $data = (array)$data;
        $parameters = [
            $data['username'],
            $data['email'],
            $data['first_name'],
            $data['last_name'],
        ];
        if ($id > 0) {
            $data['id'] = $id;
            array_push($parameters, $id);
        }


        if (isset($data['id'])) {
            $sql = <<<SQL
UPDATE APIGILITY.ECOMMERCE_USERS
SET USERNAME   = ?,
    EMAIL      = ?,
    FIRST_NAME = ?,
    LAST_NAME  = ?
WHERE ID = ?
SQL;
            $result = $this->db->query($sql, $parameters);
        } else {
            $sql = <<<SQL
INSERT INTO APIGILITY.ECOMMERCE_USERS (USERNAME, EMAIL, FIRST_NAME, LAST_NAME)
VALUES (?, ?, ?, ?)
SQL;

            $result = $this->db->query($sql, $parameters);
            $data['id'] = $this->db->getDriver()->getLastGeneratedValue();

        }

        return $this->fetchOne($data['id']);
    }

    public function delete($id)
    {
        $QQ = new \Zend\Db\Sql\Expression('?');
        $delete = new Delete($this->table);
        $delete->where(['ID' => $QQ]);
        $result = $this->db->query($delete->getSqlString(), [$id]);

        return $result->getAffectedRows() > 0;
    }
}
