<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\CarModels;
use App\Entity\CarsBrand;
use App\Entity\CarSubmodels;
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
     */
    public function getCarActions(Request $request)
    {
        $data = $request->query->all();

        dump($data);


        $cars = $this->getDoctrine()->getRepository(Car::class)->findAll();

        return new JsonResponse($cars, 200);
    }

    /**
     * List all Brands
     * @Route("/brands", methods={"GET"})
     */
    public function getBrandsActions(Request $request)
    {
        $data = $request->query->all();

        dump($data);


        $brands = $this->getDoctrine()->getRepository(CarsBrand::class)->findBy([], ['Name' => 'ASC']);

        return new JsonResponse($brands, 200);
    }

    /**
     * List Models by Brand
     * @Route("/brands/{id}/models", methods={"GET"})
     */
    public function getModelsByBrandActions(Request $request, $id)
    {
        $data = $request->query->all();

        dump($data);


        $models = $this->getDoctrine()->getRepository(CarModels::class)->findBy(["carBrand" => $id], ['name' => 'ASC']);

        return new JsonResponse($models, 200);
    }

    /**
     * List SubModels by Models
     * @Route("/model/{id}/submodels", methods={"GET"})
     */
    public function getSubModelsByModelActions(Request $request, $id)
    {
        $data = $request->query->all();

        dump($data);


        $submodels = $this->getDoctrine()->getRepository(CarSubmodels::class)->findBy(["carModel" => $id], ['name' => 'ASC']);

        return new JsonResponse($submodels, 200);
    }

    /**
     *Create Car.
     * @Rest\Route("/cars", methods={"POST"})
     */
    public function postCarAction(Request $request)
    {
        // get data
        $data = $request->request->all();
        // validate data

        if (empty($data['Brand'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Brand'], 400);
        }
        if (empty($data['Model'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'Model'], 400);
        }
        if (empty($data['SubModel'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'SubModel'], 400);
        }
        if (empty($data['User'])) {
            return new JsonResponse(['code' => '', 'erreur' => 'User'], 400);
        }

        $user = $this->getUser();
        $brand = $this->getDoctrine()->getRepository(CarsBrand::class)->findBy(['id' => $data['Brand']]);
        $model = $this->getDoctrine()->getRepository(CarModels::class)->findBy(['id' => $data['Model']]);
        $subModel = $this->getDoctrine()->getRepository(CarSubmodels::class)->findBy(['id' => $data['SubModel']]);

        $brand = array_pop($brand);
        $model = array_pop($model);
        $subModel = array_pop($subModel);

        $car = new Car();
        $car->setBrand($brand);
        $car->setModel($model);
        $car->setSubModel($subModel);
        $car->setUser($user);


        $this->getDoctrine()->getManager()->persist($car);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse('Car was created', 200);

    }


}