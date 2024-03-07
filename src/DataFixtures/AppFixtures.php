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
		$brandName = [
			'Samsung',
			'Apple',
			'Huawei',
			'LG',
		];
	 
		foreach ($brandName as $brandName) {
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
	
	    $iphone = (new Category())
		    ->setName('Iphone')
		    ->setCategory($parent);
	    $manager->persist($iphone);
    }
}
