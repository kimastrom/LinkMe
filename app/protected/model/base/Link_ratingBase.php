<?php
Doo::loadCore('db/DooModel');

class Link_ratingBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $user_id;

    /**
     * @var int Max length is 11.
     */
    public $link_id;

    /**
     * @var tinyInt Max length is 4
     */
    public $rating;

    public $_table = 'link_rating';
    public $_primarykey = 'id';
    public $_fields = array('id', 'user_id', 'link_id', 'rating');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),
                'user_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),
                'link_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 4 ),
                        array( 'optional' ),
                )
                
            );
    }

}