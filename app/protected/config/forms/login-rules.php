<?php

return array(
        'username'=>array(
                        array('maxlength',25,'This is too long'),
                        array('minlength',3)
                    ),
        'password' => array(
                        array('maxlength',25,'This is too long'),
                        array('minlength',3)
                    )
    );

?>