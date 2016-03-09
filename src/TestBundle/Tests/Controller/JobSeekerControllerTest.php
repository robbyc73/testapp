<?php

namespace TestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobSeekerControllerTest extends WebTestCase
{
    public function testShowjobseeker()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showJobSeeker');
    }

}
