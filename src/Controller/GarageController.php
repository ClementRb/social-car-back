<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Garage;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/api", name="api_")
 */
class GarageController extends FOSRestController
{

    /**
     *Create Garage.
     * @Rest\Route("/garage", methods={"POST"})
     */
    public function postGarageAction(Request $request)
    {
        $data = $request->request->all();
        // validate data

        $user = $this->getUser();
        if (empty($data['Name'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Name'], 400);
        }

        dump($data);
        $garage = new Garage();
        $garage->setUser($user);
        $garage->setName($data['Name']);


        $this->getDoctrine()->getManager()->persist($garage);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('ok', 200);

    }

    /**
     *Get Garages.
     * @Rest\Route("/garage", methods={"GET"})
     */
    public function getGaragesAction(Request $request)
    {

        $data = $request->query->all();
        dump($data);
        $garage = $this->getDoctrine()->getRepository(Garage::class)->findBy(['user'=> $data['userId']]);

        return new JsonResponse($garage, 200);

    }

    /**
     *Add a car
     * @Rest\Route("/garage/car/{id}", methods={"POST"})
     * @param int $id
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function addCarToGarage(Request $request, $id)
    {

        $data = $request->request->all();

        dump($data);

        $garage = $this->getDoctrine()->getRepository(Garage::class)->findBy(['id' => $data['garage_id']]);
        $car = $this->getDoctrine()->getRepository(Car::class)->findBy(['id' => $id]);

        $car = array_pop($car);
        dump($car);
        dump($garage[0]);

        $car->setGarage($garage[0]);

        $this->getDoctrine()->getManager()->persist($car);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('ok', 200);

    }
}