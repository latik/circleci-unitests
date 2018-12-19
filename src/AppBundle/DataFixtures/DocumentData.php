<?php

namespace AppBundle\DataFixtures;

use AppBundle\Document\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class DocumentData extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; ++$i) {
            $product = new Product();
            $product->setName('A Foo Bar');
            $product->setPrice('19.99');

            $manager->persist($product);
        }

        $manager->flush();
    }
}
