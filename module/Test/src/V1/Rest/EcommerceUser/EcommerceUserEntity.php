<?php
namespace Test\V1\Rest\EcommerceUser;

class EcommerceUserEntity
{
	public $id;
	public $username;
	public $email;
	public $first_name;
	public $last_name;
	public $created_at;
	public $modified_at;

	public function getArrayCopy()
	{
        return get_object_vars($this);
	}

	public function populate($data)
	{
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
	}
}
