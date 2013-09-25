<?php
/**
* phpCan - http://idc.anavallasuiza.com/
*
* phpCan is released under the GNU Affero GPL version 3
*
* More information at license.txt
*/

defined('ANS') or die();

$config['css'] = array(
    'default' => array(
        'plugins' => array(
            'Variables',
            'VendorPrefixes'
        ),
        'stringfy' => array(
            'sourceMap' => true,
            'comments' => false
        )
    )
);
