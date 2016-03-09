<?php

namespace TestBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskApiControllerTest extends WebTestCase
{
    public function testDeletejobseeker()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteJobSeeker');
    }

    public function testGetjobseeker()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getJobSeeker');
    }

}
