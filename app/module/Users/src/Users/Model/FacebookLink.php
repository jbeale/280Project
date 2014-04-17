<?php
namespace Users\Model;

class FacebookLink
{
    public $linkId;
    public $facebookId;
    public $userId;

    public function exchangeArray($data)
    {
        $this->linkId = (!empty($data['linkId'])) ? $data['linkId'] : null;
        $this->facebookId = (!empty($data['facebookId'])) ? $data['facebookId'] : null;
        $this->userId = (!empty($data['userId'])) ? $data['userId'] : null;
    }
}