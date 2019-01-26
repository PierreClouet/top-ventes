<?php

namespace App\DataFixtures;

use App\Entity\OrderItems;
use App\Entity\Orders;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Category;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $productList    = array();
        $categoryList   = array();
        $orderList      = array();

        for ($i = 0; $i < 10; $i++) {
            $category = new Category();
            $category->setName("Category - " . ($i + 1));
            $manager->persist($category);
            $categoryList[] = $category;
        }

        for ($i = 1; $i < 30; $i++) {
            $product = new Product();
            $product->setName("Produit - " . $i);
            $product->setPrice(rand(1, 20));
            $product->setCategory($categoryList[rand(0, count($categoryList) - 1)]);
            $manager->persist($product);
            $productList[] = $product;
        }

        for ($i = 0; $i < 30; $i++) {
            $order = new Orders();
            $order->setName("Commande - " . ($i + 1));
            $manager->persist($order);
            $orderList[] = $order;
        }

        for ($i = 0; $i < count($orderList) - 1; $i++) {
            $n = rand(1, 5);
            $productListAlreadyTake = array();

            for ($m = 0; $m < $n; $m++) {
                $p = $productList[rand(0, count($productList) - 1)];

                if (!in_array($p, $productListAlreadyTake)) {
                    $orderItem = new OrderItems();
                    $orderItem->setProduct($p);
                    $orderItem->setQuantity(rand(1, 5));
                    $orderItem->setOrders($orderList[$i]);
                    $manager->persist($orderItem);
                    $productListAlreadyTake[] = $p;
                }
            }
        }

        $manager->flush();
    }
}
