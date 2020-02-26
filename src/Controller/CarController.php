<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Garage;
use App\Entity\User;
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
class CarController extends FOSRestController
{
    /**
     * @Route("/user", name="api_user",  methods={"GET"})
     * @param Request $request
     * @param UserManagerInterface $userManager
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getUserInfo(Request $request, UserManagerInterface $userManager)
    {
        $data = $request->request->all();
        $users = $this->getUser();

        return new JsonResponse(['user' => $users], 200);
    }

    /**
     * List all cars
     * @Route("/cars", methods={"GET"})
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function getCarActions(Request $request)
    {
        $data = $request->request->all();
        $cars = $this->getDoctrine()->getRepository(Car::class)->findBy();

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

        $yearDate = new \DateTime($data['Year']);
        $car = new Car();
        $car->setYear($yearDate);
        $car->setBrand($data['Brand']);
        $car->setModel($data['Model']);
        $car->setUser($data['User']);


        $this->getDoctrine()->getManager()->persist($car);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('ok', 200);

    }


}