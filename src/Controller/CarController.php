<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Car;
use Symfony\Component\Validator\Constraints\DateTime;

class CarController extends FOSRestController
{
    /**
     * List all cars
     * @Route("/cars", methods={"GET"})
     */
    public function getCarActions()
    {
        $repository = $this->getDoctrine()->getRepository(User::class);
        $cars = $repository->findAll();
        return new JsonResponse($cars, 200);
    }

    /**
     *Create Car.
     * @Rest\Route("/cars", methods={"POST"})
     */
    public function postCarAction(Request $request)
    {
        //vérif auth


        // get data
        $data = $request->request->all();
        dump($data['Year']);
        // validate data

        if (empty($data['Year'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Year'], 400);
        }
        if (empty($data['Brand'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Brand'], 400);
        }
        if (empty($data['Model'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Model'], 400);
        }

        $yearDate = new DateTime($data['Year']);
        $car = new Car();
        $car->setYear($yearDate);
        $car->setBrand($data['Brand']);
        $car->setModel($data['Model']);
        //$car->setUser($data['User']);


        $this->getDoctrine()->getManager()->persist($car);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('ok', 200);

    }
}