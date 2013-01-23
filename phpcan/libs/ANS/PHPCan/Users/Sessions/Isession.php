<?php
/*
* phpCan - http://idc.anavallasuiza.com/
*
* phpCan is released under the GNU Affero GPL version 3
*
* More information at license.txt
*/

namespace ANS\PHPCan\Users\Sessions;

defined('ANS') or die();

interface Isession {
    public function __construct ($settings);

    public function setConditions ($conditions);
    public function load ();
    public function login ($data = array());
    public function logout ();
}
