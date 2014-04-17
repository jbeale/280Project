<?php
namespace Users\Model;

use Zend\Db\TableGateway\TableGateway;

class UserTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway= $tableGateway;
    }

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    public function getUser($id)
    {
        $id = (int)$id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            return null;
        }
        return $row;
    }

    public function findUser($username)
    {
        $rowset = $this->tableGateway->select(array('username' => $username));
        $row = $rowset->current();
        if (!$row) {
            return null;
        }
        return $row;
    }

    public function createUser(User $user)
    {
        $data = array(
            'username' => $user->username,
            'password' => $user->password,
            'email'    => $user->email,
            'name'     => $user->name
        );
        $this->tableGateway->insert($data);
    }
}