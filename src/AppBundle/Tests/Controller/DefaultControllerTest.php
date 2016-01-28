<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testDataSource()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/get-ajax-data', array('keyword' => ''));
        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $crawler = $client->request('POST', '/get-ajax-data', array('keyword' => 't'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('t(', $crawler->text());

        $crawler = $client->request('POST', '/get-ajax-data', array('keyword' => 'test'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('test(', $crawler->text());

        $crawler = $client->request('POST', '/get-ajax-data', array('keyword' => 'testnil'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('N/A', $crawler->text());

        $crawler = $client->request('POST', '/get-ajax-data', array('keyword' => 'xyz'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('xyz(', $crawler->text());


    }
}
