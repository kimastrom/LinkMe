<?php
Doo::loadModel('base/UserBase');

class User extends UserBase
{
    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 25.
     */
    public $username;

    /**
     * @var varchar Max length is 20.
     */
    public $pwd;

    /**
     * @var varchar Max length is 15.
     */
    public $group;

    /**
     * @var int Max length is 11.
     */
    public $vip;

    public $_table = 'user';
    public $_primarykey = 'id';
    public $_fields = array('id', 'username', 'pwd', 'group', 'vip');

    public function __construct($data = null)
    {
        parent::__construct($data);
        parent::setupModel(__CLASS__);
    }
    
    public function addUser() {
        Doo::loadHelper('CryptionHandler');
        $cryptop = new CryptionHandler();
        $this->pwd = $cryptop->crypto($this->pwd);
        $this->insert();
    }
    
    public function getUser() {
        Doo::loadHelper('CryptionHandler');
        $cryptop = new CryptionHandler();
        $this->pwd = $cryptop->crypto($this->pwd);
        return $this->find(array('limit' => 1));   
    }

}
