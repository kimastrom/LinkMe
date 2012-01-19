<?php
Doo::loadModel('base/CategoryBase');

class Category extends CategoryBase
{
    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 50.
     */
    public $category;

    public $_table = 'category';
    public $_primarykey = 'id';
    public $_fields = array('id', 'category');

    public function __construct($data = null)
    {
        parent::__construct($data);
        parent::setupModel(__CLASS__);
    }

}
