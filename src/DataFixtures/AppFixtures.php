<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $brandsName = [
            'Samsung',
            'Apple',
            'LG',
            'Sony',
            'Huawei',
            'Xiaomi',
            'Motorola',
            'Nokia',
            'HTC',
            'Lenovo',
            'Asus',
            'Acer',
            'OnePlus',
            'BlackBerry',
            'Google',
            'Alcatel',
            'ZTE',
            'TCL',
            'Vivo',
            'Oppo',
            'Realme',
            'Meizu',
            'Coolpad',
            'Infinix',
            'Tecno',
            'Honor',
            'Micromax',
            'Lava',
            'Gionee',
            'LeEco',
            'Panasonic',
            'Yu',
        ];

        foreach ($brandsName as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $manager->persist($brand);
        }

        $parent = new Category();
        $parent->setName('Smartphone');
        $manager->persist($parent);

        $android = (new Category())
            ->setName('Android')
            ->setCategory($parent);
        $manager->persist($android);

        $iphone = new Category();
        $iphone->setName('iPhone');
        $iphone->setCategory($parent);
        $manager->persist($iphone);


        $manager->flush();
    }
}
