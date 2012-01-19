<?php
Doo::loadCore('db/DooModel');

class LinkBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var varchar Max length is 150.
     */
    public $url;

    /**
     * @var varchar Max length is 200.
     */
    public $description;

    /**
     * @var timestamp
     */
    public $date;

    /**
     * @var int Max length is 11.
     */
    public $user_id;

    /**
     * @var int Max length is 11.
     */
    public $category_id;

    public $_table = 'link';
    public $_primarykey = 'id';
    public $_fields = array('id','url','description','date','user_id','category_id');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'url' => array(
                        array( 'maxlength', 150 ),
                        array( 'notnull' ),
                ),

                'description' => array(
                        array( 'maxlength', 200 ),
                        array( 'notnull' ),
                ),

                'date' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'user_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'category_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}