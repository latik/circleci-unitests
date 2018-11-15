<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function (User $user) {
            $user->setName($this->faker->realText(20));
        });

        $manager->flush();
    }
}
