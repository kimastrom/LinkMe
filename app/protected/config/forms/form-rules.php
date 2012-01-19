<?php

return array(
        'username'=>array(
                        array('username',4,5,'username invalid'),
                        array('maxlength',6,'This is too long'),
                        array('minlength',6)
                    ),
        'pwd'=>array('password',3,5),
        'email'=>array('email'),
        'url'=>array('url'),
        'description' => array(
                        array('description',4,5,'description ska vara mellan 5-100 tecken'),
                        array('maxlength',100,'This is too long'),
                        array('minlength',5)
        )
    );

?>