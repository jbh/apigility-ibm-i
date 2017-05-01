<?php
namespace SA\Adapter;

use Zend\Paginator\Adapter\DbSelect;


class LowercaseDbSelect extends DbSelect
{
    public function count()
    {
        if ($this->rowCount !== null) {
            return $this->rowCount;
        }

        $select = $this->getSelectCount();

        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result    = $statement->execute();
        $row       = $result->current();

        $this->rowCount = (int) $row['c'];

        return $this->rowCount;
    }
}
