<?php

return array(
        'username' => array(
                        array('maxlength',25,'This is too long'),
                        array('minlength',5)
        ),
        'repeatpassword' => array(
                        array('maxlength',25,'This is too long'),
                        array('minlength',5)
        ),
        'password' => array(
                        array('maxlength',25,'This is too long'),
                        array('minlength',5),
                        //array('equalAs','password','post','repeatpassword',)
      ),
    );

?>