<?php

namespace App;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


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
    const DB_HOST = 'budget.adrian-zuchowski.profesjonalnyprogramista.pl.mysql.dhosting.pl';

    /**
     * Database name
     * @var string
     */
    const DB_NAME = 'geich3_budgetad';

    /**
     * Database user
     * @var string
     */
    const DB_USER = 'aojoh9_budgetad';

    /**
     * Database password
     * @var string
     */
    const DB_PASSWORD = 'ohrahshu1She';

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
    const MAIL_USERNAME = 'confirmation.personal.budget@gmail.com';

    /**
     * Mail password
     *
     * @var string
     */
    const MAIL_PASSWORD = 'PersonalBudgetKonto1@';

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
    const MAIL_SMTP_PORT = '587';

    /**
     * Mail sender name
     *
     * @var string
     */
    const MAIL_SENDER_NAME = 'Potwierdzenie';

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