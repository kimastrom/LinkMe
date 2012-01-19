<?php

// anonymous user can only access Blog index page.
$acl['anonymous']['allow'] = array(
                            'LinkController' => array(
                                                '*'
                                             ),
                             'AuthController' => array(
                                                '*'
                                             )
                            );

$acl['admin']['allow'] = 
$acl['member']['allow'] = array(
                            'LinkController'=>'*', 
                            'BlogController'=>'*', 
                        );
