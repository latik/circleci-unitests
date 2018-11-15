<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 20; ++$i) {
            $user = new User();
            $user->setName(sprintf('user %s', $i));
            $user->setEmail(sprintf('user-%s@example.com', $i));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
