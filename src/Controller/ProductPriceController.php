<?php

namespace App\Controller;

use App\Entity\Device;
use App\Entity\Price;
use App\Entity\Product;
use App\Repository\DeviceRepository;
use App\Repository\PriceRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductPriceController extends AbstractController
{
    #[Route('/test', name: 'app_product_price')]
    public function index(ProductRepository $productRepository, PriceRepository $priceRepository, DeviceRepository $deviceRepository, EntityManagerInterface $entityManager): Response
    {
/*
        $productRepository->add($product1 = new Product(), true);
        $priceRepository->add(new Price($product1, 100), true);
        $priceRepository->add(new Price($product1, 200), true);
        $priceRepository->add(new Price($product1, 300), true);

        $productRepository->add($product2 = new Product(), true);
        $priceRepository->add(new Price($product2, 100), true);
        $priceRepository->add(new Price($product2, 200), true);
        $priceRepository->add(new Price($product2, 300), true);

        $deviceRepository->add(new Device($product1), true);
        $deviceRepository->add(new Device($product2), true);
*/
        $all = $deviceRepository->findAll();
        //$product->setCurrentPrice($priceRepository->find(6));
        //$productRepository->add($product,true);
        //dd($productRepository->findAll());
        foreach ($all as $item)
        {
            dump([$item, $item->getProduct()->getCurrentPrice()]);
        }
        //die();
//dd(...array_map(fn(Product $product)=>[$product, $product->getPrices()->toArray(),], $all));//$product->getCurrentPrice()],$all));
        return $this->render('empty.html.twig');
    }
}
