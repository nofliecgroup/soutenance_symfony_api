<?php

namespace App\Controller;

use App\Repository\StudentsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StudentsController extends AbstractController
{
    #[Route('/api/students', name: 'getAllStudents', methods: ['GET'])]
    public function getAllStudents(StudentsRepository $studentsRepository,  SerializerInterface $serializer): JsonResponse
    {
        $studentsList = $studentsRepository->findAll();

        $jsonStudentsList = $serializer->serialize($studentsList, 'json', ['groups' => 'getStudents', 'getDrivers']);
        return new JsonResponse($jsonStudentsList, Response::HTTP_OK, [], true);
    }

    
    #[Route('/api/students/{id}', name: 'getStudentById', methods: ['GET'])]
    public function getStudentById(int $id, StudentsRepository $studentsRepository, SerializerInterface $serializer): JsonResponse
    {
       if ($studentsRepository->find($id)) {
            $student = $studentsRepository->find($id);

            $jsonStudent = $serializer->serialize($student, 'json', ['groups' => 'getStudents', 'getDrivers']);
            return new JsonResponse($jsonStudent, Response::HTTP_OK, [], true);
        } else {
            return new JsonResponse('Student not found', Response::HTTP_NOT_FOUND, [], true);
        }

    }

    #[Route('/api/students', name: 'addStudent', methods: ['POST'])]
    public function addStudent(StudentsRepository $studentsRepository, SerializerInterface $serializer): JsonResponse
    {
        $student = $studentsRepository->addStudent();

        $jsonStudent = $serializer->serialize($student, 'json', ['groups' => 'getStudents', 'getDrivers']);
        return new JsonResponse($jsonStudent, Response::HTTP_OK, [], true);
    }

    #[Route('/api/students/{id}', name: 'updateStudent', methods: ['PUT'])]
    public function updateStudent(int $id, StudentsRepository $studentsRepository, SerializerInterface $serializer): JsonResponse
    {
       if ($id) {
            $student = $studentsRepository->updateStudent($id);

            $jsonStudent = $serializer->serialize($student, 'json', ['groups' => 'getStudents', 'getDrivers']);
            return new JsonResponse($jsonStudent, Response::HTTP_OK, [], true);
        } else {
            return new JsonResponse('Student not found', Response::HTTP_NOT_FOUND, [], true);
        }
    }

    #[Route('/api/students/{id}', name: 'deleteStudent', methods: ['DELETE'])]

    public function deleteStudent(int $id, StudentsRepository $studentsRepository, SerializerInterface $serializer): JsonResponse
    {
       if ($id) {
            $student = $studentsRepository->deleteStudent($id);

            $jsonStudent = $serializer->serialize($student, 'json', ['groups' => 'getStudents', 'getDrivers']);
            return new JsonResponse($jsonStudent, Response::HTTP_OK, [], true);
        } else {
            return new JsonResponse('Student not found', Response::HTTP_NOT_FOUND, [], true);
        }
    }



}
