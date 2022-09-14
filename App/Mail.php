<?php

namespace App;

use App\Config;
use Mailgun\Mailgun;

/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */
    public static function send($to, $subject, $text, $headers)
    {
        $mg = new mail();
        $domain = Config::MAILGUN_DOMAIN;

        $mg->send(                 'to'      => $to,
                                   'subject' => $subject,
                                   'text'    => $text,
                                   'headers' => $headers);
    }
}
