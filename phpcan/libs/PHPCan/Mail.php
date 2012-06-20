<?php
/*
* phpCan - http://idc.anavallasuiza.com/
*
* phpCan is released under the GNU Affero GPL version 3
*
* More information at license.txt
*/

namespace PHPCan;

defined('ANS') or die();

class Mail extends \PHPMailer\PHPMailer
{
    public function __construct ()
    {
        parent::__construct();

        global $Config;

        if (!$Config->mail) {
            $Config->load('mail.php', 'scene');
        }

        $this->setParams($Config->mail);
    }

    public function setParams ($params)
    {
        if (!$params) {
            return false;
        }

        $this->CharSet = $params['charset'];
        $this->From = $params['from'];
        $this->FromName = $params['fromname'];
        $this->Host = $params['host'];
        $this->Port = $params['port'];
        $this->SMTPSecure = $params['secure'];
        $this->SMTPAuth = $params['auth'];
        $this->Username = $params['user'];
        $this->Password = $params['password'];
        $this->Timeout = $params['timeout'];
        $this->SMTPDebug = $params['debug'];

        if ($params['sendmail']) {
            $this->isSendMail();
        } else {
            $this->isSmtp();
        }

        $this->IsHTML(true);
    }
}