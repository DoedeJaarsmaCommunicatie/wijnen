<?php

namespace App\Mail;

defined('ABSPATH') || exit(0);

use App\Bootstrap\Env;
use Symfony\Component\Mailer\Transport;

class Mailer
{
    /**
     * @var \Symfony\Component\Mailer\Mailer
     */
    private $mailer;
    protected $dsn = 'sendmail+smtp://default';

    protected function getTransport()
    {
        if (defined('WP_DEBUG') && WP_DEBUG) {
            return new Transport\Smtp\EsmtpTransport(
                'sendmailhog',
                1025,
                null
            );
        }

        return Transport::fromDsn(Env::get('DSN', $this->dsn));
    }


    public static function send(Mailable $mailable)
    {
        $mailer = new static();
        $mailer ->setMailer();

        $mailer->mailer->send($mailable->build());
    }

    public function setMailer()
    {
        $this->mailer = new \Symfony\Component\Mailer\Mailer($this->getTransport());
    }
}
