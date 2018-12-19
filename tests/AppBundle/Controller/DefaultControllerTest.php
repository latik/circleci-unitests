<?php

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\AppFixture;
use AppBundle\Repository\UserRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/');

        $this->isSuccessful($client->getResponse());

        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    public function testFixtures()
    {
        $this->loadFixtures([
            AppFixture::class,
        ]);

        $userRepo = $this->getContainer()->get(UserRepository::class);

        $this->assertCount(19, $userRepo->findAll());
    }

    public function testSkip()
    {
        static::markTestSkipped();

        $this->assertTrue(false);
    }

    public function testIncomplete()
    {
        static::markTestIncomplete();

        $this->assertTrue(false);
    }
}
