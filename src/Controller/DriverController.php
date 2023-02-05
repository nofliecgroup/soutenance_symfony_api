<?php

namespace App\Controller;

use App\Repository\DriverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DriverController extends AbstractController
{
    #[Route('/api/drivers', name: 'getAllDrivers', methods: ['GET'])]
    public function getAllDrivers(DriverRepository $driverRepository, SerializerInterface $serializer ): JsonResponse
    {
        $driverList = $driverRepository->findAll();

        $jsondriverList = $serializer->serialize($driverList, 'json', ['groups' => 'getDrivers', 'getStudents']);
       return new JsonResponse($jsondriverList, Response::HTTP_OK, [], true);
    }

    #[Route('/api/drivers/{id}', name: 'getDriverById', methods: ['GET'])]
    public function getDriverById(int $id, DriverRepository $driverRepository, SerializerInterface $serializer): JsonResponse
    {
       if ($driverRepository->find($id)) {
           $driver = $driverRepository->find($id);
           $jsonDriver = $serializer->serialize($driver, 'json', ['groups' => 'getDrivers', 'getStudents']);
           return new JsonResponse($jsonDriver, Response::HTTP_OK, [], true);
       } else {
           return new JsonResponse('Driver with id not found', Response::HTTP_NOT_FOUND, [], true);
       }
    }

    #[Route('/api/drivers', name: 'addDriver', methods: ['POST'])]
    public function addDriver(Request $request, SerializerInterface $serializer, EntityManagerInterface $em): JsonResponse
    {
       $driver = $serializer->deserialize($request->getContent(), Driver::class, 'json');
   
       $em->persist($driver);
       $em->flush();
       $jsonDriver = $serializer->serialize($driver, 'json', ['groups' => 'getDrivers', 'getStudents']);

       $location = $this->generateUrl('getDriverById', ['id' => $driver->getId()]);
    
       return new JsonResponse($jsonDriver, Response::HTTP_CREATED, ['Location' => $location], true);
       
       //return new JsonResponse($jsonDriver, Response::HTTP_CREATED, [], true);

    }

    #[Route('/api/drivers/{id}', name: 'updateDriver', methods: ['PUT'])]

    public function updateDriver(int $id, DriverRepository $driverRepository, SerializerInterface $serializer): JsonResponse
    {
        if ($driverRepository->find($id)) {
            $driver = $driverRepository->updateDriver($id);
            $jsonDriver = $serializer->serialize($driver, 'json', ['groups' => 'getDrivers', 'getStudents']);
            return new JsonResponse($jsonDriver, Response::HTTP_OK, [], true);
        } else {
            return new JsonResponse('Driver with '.$id. 'id not found', Response::HTTP_NOT_FOUND, [], true);
        }

    }

    #[Route('/api/drivers/{id}', name: 'removeDriver', methods: ['DELETE'])]
    public function removeDriver(int $id, DriverRepository $driverRepository, EntityManagerInterface $em): JsonResponse
    {
       $em->remove($driverRepository->find($id));
       $em->flush();
       return new JsonResponse('Driver with id '.$id.' has been removed', Response::HTTP_OK, [], true);
    }




    // #[Route('/api/drivers/{id}', name: 'deleteDriver', methods: ['DELETE'])]
    // public function deleteDriver(int $id, DriverRepository $driverRepository, SerializerInterface $serializer): JsonResponse
    // {
    //     if ($driverRepository->find($id)) {
    //         $driver = $driverRepository->deleteDriver($id);
    //         $jsonDriver = $serializer->serialize($driver, 'json', ['groups' => 'getDrivers', 'getStudents']);
    //         return new JsonResponse($jsonDriver, Response::HTTP_OK, [], true);
    //     } else {
    //         return new JsonResponse('Driver with id not found', Response::HTTP_NOT_FOUND, [], true);
    //     }   
    // }

 

}
