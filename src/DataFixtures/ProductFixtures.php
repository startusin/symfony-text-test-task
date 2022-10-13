<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 30; $i++) {
            $product = new Product();
            $product->setName('test-' . $i);
            $product->setPrice($i - 0.08);
            $manager->persist($product);
        }

        $manager->flush();
    }
}
