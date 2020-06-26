<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Repository\CompanyRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticularController extends AbstractController
{
    private function serialize($data)
    {
        return $this->container->get('serializer')->serialize($data, 'json');
    }

    private function deserialize($data, $entity)
    {
        return $this->container->get('serializer')->deserialize($data, $entity, 'json');
    }


    /**
     * @Route("/api/particular/update", name="api_particular_update", methods="PUT")
     */
    public function update(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepo)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser()->getId();

        // User information
        $user = $userRepo->find($user);

        $password = $passwordEncoder->encodePassword($user, $user->getPassword());

        $user->setPassword($password);

        $entityManager->persist($user);

        foreach($user->getParticular() as $user) {
            $user->setFirstName('Gérome');
        }

        $entityManager->persist($user);

        $entityManager->flush();

        $response = new Response();

        $response->setStatusCode(Response::HTTP_CREATED);

        $response->setContent(json_encode([
            'Success' => "L'utilisateur a bien été modifier",
        ]));
        $response->headers->set('Content-Type', 'application/json');
        
        return $response;

        return $user;
    }
}
