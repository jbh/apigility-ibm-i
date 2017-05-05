<?php
namespace Test\V1\Rest\EcommerceUser;

use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Where;

class EcommerceUserFilters
{
    public static function defaultFilter($filters = [])
    {
        return function (Where $where) use ($filters) {
            foreach ($filters as $filter => $value) {
                $where->expression("{$filter} = ?", $value);
            }
        };
    }

    public static function idFilter($id)
    {
        return function (Where $where) use ($id) {
            $where->expression('ID = ?', $id);
        };
    }

    public static function usersWithUsernameLike($username)
    {
        return function (Where $where) use ($username) {
            $where->expression('USERNAME LIKE ?', "%$username%");
        };
    }
}
