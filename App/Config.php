<?php

namespace App;

/**
 * Application configuration
 *
 * PHP version 7.0
 */
class Config
{

    /**
     * Database host
     * @var string
     */
    const DB_HOST = 'database host';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'database name';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'database user';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'database password';

    /**
     * Show or hide error messages on screen
     * @var boolean
     */
    const SHOW_ERRORS = true;

    /**
     * Secret key for hashing
     * @var boolean
     */
    const SECRET_KEY = 'your-secret-key';

    /**
     * Mail host
     *
     * @var string
     */
    const MAIL_HOST = 'smtp.gmail.com';

    /**
     * Mail host authentication
     *
     * @var boolean
     */
    const MAIL_HOST_AUTHENTICATION = true;

    /**
     * Mail username
     *
     * @var string
     */
    const MAIL_USERNAME = 'mail username';

    /**
     * Mail password
     *
     * @var string
     */
    const MAIL_PASSWORD = 'mail password';

    /**
     * Mail smtp secure type
     *
     * @var string
     */
    const MAIL_SMTP_SECURE_TYPE = 'ssl';

    /**
     * Mail smtp port
     *
     * @var int
     */
    const MAIL_SMTP_PORT = '465';

    /**
     * Mail sender name
     *
     * @var string
     */
    const MAIL_SENDER_NAME = 'Potwierdzenie';

    /**
     * Mail app password
     *
     * @var string
     */
    const MAIL_APP_PASSWORD = 'mail app password';

    /**
     * Mail smtp options
     * 
     * @var string
     */
    const MAIL_SMTP_OPTIONS = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
}