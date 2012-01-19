<?php
Doo::loadCore('db/DooModel');

class CommentBase extends DooModel{

    /**
     * @var int Max length is 11.
     */
    public $id;

    /**
     * @var int Max length is 11.
     */
    public $author_id;

    /**
     * @var varchar Max length is 500.
     */
    public $comment;

    /**
     * @var timestamp
     */
    public $date;

    /**
     * @var int Max length is 11.
     */
    public $link_id;

    public $_table = 'comment';
    public $_primarykey = 'id';
    public $_fields = array('id','author_id','comment','date','link_id');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'author_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                ),

                'comment' => array(
                        array( 'maxlength', 500 ),
                        array( 'notnull' ),
                ),

                'date' => array(
                        array( 'datetime' ),
                        array( 'notnull' ),
                ),

                'link_id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}