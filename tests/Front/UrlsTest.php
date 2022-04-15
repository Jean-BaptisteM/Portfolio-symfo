<?php

namespace App\Tests\Front;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlsTest extends WebTestCase
{
    /**
     * @dataProvider urlsList
     */
    public function testUrl($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);
        
        $this->assertResponseIsSuccessful();
    }

    public function urlsList()
    {
        return [
            ['/projets/'],
        ];
    }
}