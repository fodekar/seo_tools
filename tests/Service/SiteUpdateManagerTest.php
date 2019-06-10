<?php

namespace App\Service;

use App\Service\SiteUpdateManager;
use App\Service\MessageGenerator;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use PHPUnit\Framework\TestCase;

class SiteUpdateManagerTest extends TestCase
{
    public function setUp()
    {
        $transport = (new Swift_SmtpTransport(getenv('MAILER_HOST'), getenv('MAILER_PORT')))
            ->setUsername(getenv('MAILER_USERNAME'))
            ->setPassword(getenv('MAILER_PASSWORD'));

        $this->mailer = new Swift_Mailer($transport);
    }

    public function testNotifyOfSiteUpdateOK()
    {
        if (getenv('APP_DEBUG') == true) {
            $sender = new SiteUpdateManager(new MessageGenerator, $this->mailer);
            $result = $sender->notifyOfSiteUpdate();

            $this->assertEquals(1, $result);
        }
    }
}
