<?php

namespace App\Tests\Tests;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class testentityTest extends KernelTestCase
{
    public function testentityvalid(): void
    {
         self::bootKernel();
         $container = static::getContainer();
         $category = new Category();
         $category->setName('ssad');
         $error = $container->get('validator')->validate($category);
         $this->assertCount( 0,$error);
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }


    public function testentityinvalid(): void
    {
         self::bootKernel();
         $container = static::getContainer();
         $category = new Category();
         $category->setName('[ssad]');
         $error = $container->get('validator')->validate($category);
         $this->assertCount( 0 ,$error);
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    } 
}