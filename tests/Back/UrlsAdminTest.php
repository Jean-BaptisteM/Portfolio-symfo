<?php

namespace App\Tests\Back;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlsAdminTest extends WebTestCase
{
    /**
     * @dataProvider adminUrlsListToCheck
     */
    public function testUrlAdminAccess($url): void
    {
        $client = static::createClient();
        $client->request('GET', $url);
        $this->assertResponseRedirects();

        $userRepository = static::getContainer()->get(UserRepository::class);

        // ROLE_ADMIN
        $testUser = $userRepository->findOneBy(['email' => 'jbmoisy.dev@gmail.com']);
        $client->loginUser($testUser);
        $client->request('GET', $url);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('h1');
    }

    public function adminUrlsListToCheck()
    {
        return [
            ['/back/category/'],
            ['/back/category/new'],
            ['/back/category/1'],
            ['/back/category/1/edit'],
            ['/back/cms/'],
            ['/back/cms/new'],
            ['/back/cms/1'],
            ['/back/cms/1/edit'],
            ['/back/database/'],
            ['/back/database/new'],
            ['/back/database/1'],
            ['/back/database/1/edit'],
            ['/back/framework/'],
            ['/back/framework/new'],
            ['/back/framework/1'],
            ['/back/framework/1/edit'],
            ['/back/language/'],
            ['/back/language/new'],
            ['/back/language/1'],
            ['/back/language/1/edit'],
            ['/back/operating/system/'],
            ['/back/operating/system/new'],
            ['/back/operating/system/1'],
            ['/back/operating/system/1/edit'],
            ['/back/project/'],
            ['/back/project/new'],
            ['/back/project/1'],
            ['/back/project/1/edit'],
            ['/back/software/'],
            ['/back/software/new'],
            ['/back/software/1'],
            ['/back/software/1/edit'],
            ['/back/user/'],
            ['/back/user/new'],
            ['/back/user/1'],
            ['/back/user/1/edit'],
            ['/back/versionning/'],
            ['/back/versionning/new'],
            ['/back/versionning/1'],
            ['/back/versionning/1/edit'],
        ];
    }

}
