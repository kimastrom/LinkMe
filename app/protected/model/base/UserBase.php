<?php
Doo::loadCore('db/DooModel');

class UserBase extends DooModel{

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
    public $_fields = array('id','username','pwd','group','vip');

    public function getVRules() {
        return array(
                'id' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'optional' ),
                ),

                'username' => array(
                        array( 'maxlength', 25 ),
                        array( 'notnull' ),
                ),

                'pwd' => array(
                        array( 'maxlength', 20 ),
                        array( 'notnull' ),
                ),

                'group' => array(
                        array( 'maxlength', 15 ),
                        array( 'notnull' ),
                ),

                'vip' => array(
                        array( 'integer' ),
                        array( 'maxlength', 11 ),
                        array( 'notnull' ),
                )
            );
    }

}