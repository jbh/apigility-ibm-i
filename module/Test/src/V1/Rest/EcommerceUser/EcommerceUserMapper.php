<?php
namespace Test\V1\Rest\EcommerceUser;

use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Update;
use Zend\Db\Sql\Delete;
use Zend\Db\Sql\TableIdentifier;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Adapter\Adapter;
use SA\Adapter\LowercaseDbSelect;

class EcommerceUserMapper
{
    protected $db;
    protected $sql;
    protected $table;

    public function __construct(Adapter $db)
    {
        $this->db = $db;
        $this->sql = new Sql($db);
        $this->table = new TableIdentifier('ECOMMERCE_USERS', 'APIGILITY');
    }

    public function fetchAll($filters = [])
    {
        $select = empty($filters)
            ? $this->getNewSimpleSelect()
            : $this->applyFilters($this->getNewSimpleSelect(), $filters);

        $paginatorAdapter = new LowercaseDbSelect($select, $this->db);
        $collection = new EcommerceUserCollection($paginatorAdapter);
        return $collection;
    }

    public function fetchOne($id)
    {
        $select = $this->getNewSimpleSelect();
        $select->where(EcommerceUserFilters::idFilter($id));
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $current = $result->current();

        if (!$current) {
            return false;
        }

        $entity = new EcommerceUserEntity();
        $entity->populate($current);
        return $entity;
    }

    public function save($data, $id = 0)
    {
        $parameters = [
            $data->username,
            $data->email,
            $data->first_name,
            $data->last_name,
        ];
        if ($id > 0) {
            array_push($parameters, $id);
        }

        $result = $id > 0 ? $this->update($id, $parameters) : $this->insert($parameters);
        $id = $this->db->getDriver()->getLastGeneratedValue();

        return $this->fetchOne($id);
    }

    public function update($id, $parameters)
    {
        $update = new Update($this->table);
        $update->set([
            'USERNAME' => new Expression('?'),
            'EMAIL' => new Expression('?'),
            'FIRST_NAME' => new Expression('?'),
            'LAST_NAME' => new Expression('?'),
        ]);
        $update->where(EcommerceUserFilters::idFilter($id));
        $statement = $this->sql->prepareStatementForSqlObject($update);

        return $statement->execute($parameters);
    }

    public function insert($parameters)
    {
        $insert = new Insert($this->table);
        $insert->values([
            'USERNAME' => new Expression('?'),
            'EMAIL' => new Expression('?'),
            'FIRST_NAME' => new Expression('?'),
            'LAST_NAME' => new Expression('?'),
        ]);
        $statement = $this->sql->prepareStatementForSqlObject($insert);

        return $statement->execute($parameters);
    }

    public function delete($id)
    {
        $delete = new Delete($this->table);
        $delete->where(EcommerceUserFilters::idFilter($id));
        $statement = $this->sql->prepareStatementForSqlObject($delete);
        $result = $statement->execute();

        return $result->getAffectedRows() > 0;
    }

    /**
     * Used to keep column selection consistent. Handy when using data methods, like TRIM()
     * Using TRIM as an example here although it is unnecessary in this context.
     *
     * @return array
     */
    private function getColumnsForSelect()
    {
        return [
            'ID'          => 'ID',
            'USERNAME'    => new Expression('TRIM(USERNAME)'),
            'EMAIL'       => 'EMAIL',
            'FIRST_NAME'  => 'FIRST_NAME',
            'LAST_NAME'   => 'LAST_NAME',
            'CREATED_AT'  => 'CREATED_AT',
            'MODIFIED_AT' => 'MODIFIED_AT',
        ];
    }

    private function getNewSimpleSelect()
    {
        $select = new Select($this->table);
        $select->columns($this->getColumnsForSelect());

        return $select;
    }

    private function applyFilters(Select $select, $filters)
    {
        $keys = array_keys((array)$filters);
        $firstKey = count($keys) > 0 ? $keys[0] : false;

        if (array_key_exists('sort', $filters)) {
            // Example sort: ?sort=username, email DESC
            $select->order(new Expression($filters['sort']));
            unset($filters['sort']);
        }

        $filtersClass = 'Test\V1\Rest\EcommerceUser\EcommerceUserFilters';

        $isCustomFilter = $firstKey
            && $firstKey !== 'defaultFilter'
            && method_exists($filtersClass, $firstKey);

        $where = $isCustomFilter                                                  // If this is a custom filter
            ? call_user_func("{$filtersClass}::{$firstKey}", $filters[$firstKey]) // Apply the custom filter
            : EcommerceUserFilters::defaultFilter($filters);                      // Else apply default filter

        $select->where($where);

        return $select;
    }
}
