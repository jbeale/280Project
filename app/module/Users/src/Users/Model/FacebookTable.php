<?php
namespace Users\Model;

use Zend\Db\TableGateway\TableGateway;

class FacebookTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway= $tableGateway;
    }

    public function getUserIdFromFacebookId($facebookId) {
        $id = (int)$facebookId;

        $rowset = $this->tableGateway->select(array('facebookId' => $id));
        $row = $rowset->current();
        if (!$row) {
            return null;
        }
        return $row->userId;
    }

    public function linkUser($userId, $facebookId)
    {
        $data = array(
            'facebookId' => $facebookId,
            'userId' => $userId
        );
        $this->tableGateway->insert($data);
    }
}