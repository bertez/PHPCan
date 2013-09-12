<?php
/*
* phpCan - http://idc.anavallasuiza.com/
*
* phpCan is released under the GNU Affero GPL version 3
*
* More information at license.txt
*/

namespace ANS\PHPCan\Apis\Google;

defined('ANS') or die();

use \ANS\PHPCan\Apis;

//API Documentations: http://code.google.com/apis/websearch/docs/reference.html

class Search extends \ANS\PHPCan\Apis\Api
{
    /**
     * public function search (string/array $data, [int $cache], [boolean $return_array])
     *
     * return array
     */
    public function search ($data, $cache = null, $return_array = true)
    {
        if (is_string($data)) {
            $data = array('q' => $data);
        }

        $data['v'] = '1.0';

        $return = $this->getJSON('http://ajax.googleapis.com/ajax/services/search/web', $data, $cache);

        if ($return_array) {
            return $this->toArray($return);
        }
    }
}
