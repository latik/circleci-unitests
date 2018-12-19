<?php

namespace Tests\AppBundle\Controller;

use AppBundle\DataFixtures\AppFixture;
use AppBundle\DataFixtures\DocumentData;
use AppBundle\Document\Product;
use AppBundle\Repository\ProductRepository;
use AppBundle\Repository\UserRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     * @test
     */
    public function indexAction()
    {
        $client = $this->makeClient();

        $crawler = $client->request('GET', '/');

        $this->isSuccessful($client->getResponse());

        $this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }

    /**
     * @test
     */
    public function fixtures()
    {
        $this->loadFixtures([
            AppFixture::class,
        ]);

        $userRepo = $this->getContainer()->get(UserRepository::class);

        $this->assertCount(19, $userRepo->findAll());
    }

    /**
     * @test
     */
    public function skip()
    {
        static::markTestSkipped();

        $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function incomplete()
    {
        static::markTestIncomplete();

        $this->assertTrue(false);
    }

    /**
     * @test
     */
    public function mongoDocumentCreate()
    {
        $this->loadFixtures([], null, 'doctrine_mongodb');

        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');

        $dm = $this->getContainer()->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();

        $productRepository = $this->getContainer()->get('doctrine_mongodb')->getRepository(Product::class);
        $this->assertCount(1, $productRepository->findAll());

        $productRepositoryDirect = $this->getContainer()->get(ProductRepository::class);
        $this->assertCount(1, $productRepositoryDirect->findAll());
    }

    /**
     * @test
     */
    public function mongoDocumentFixtures()
    {
        static::markTestIncomplete();

        $fixtures = [
            DocumentData::class,
        ];

        $this->loadFixtures($fixtures, null, 'doctrine_mongodb');
    }
}
