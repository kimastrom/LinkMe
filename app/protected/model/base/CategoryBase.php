<?php
Doo::loadCore('db/DooModel');

class CategoryBase extends DooModel{

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
    public $_fields = array('id','category');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'category' => array(
                        array( 'maxlength', 50 ),
                        array( 'notnull' ),
                )
            );
    }

}