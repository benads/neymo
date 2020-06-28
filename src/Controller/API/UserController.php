<?php

namespace App\Controller\API;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private function serialize($data)
    {
        return $this->container->get('serializer')->serialize($data, 'json');
    }

    /**
     * @Route("/api/me", name="api_me", methods="GET")
     */
    public function getCurrentUser()
    {
        $companyArray = [];

        foreach ($this->getUser()->getCompanies() as $company) {
            $companyArray[] = [
                'id' => $company->getId(),
                'type' => 'company',
                'first_name' => $company->getFirstName()
            ];
        }

        if ($this->verifyCompanyAccountExist($companyArray)) {
            $company = $companyArray;

            $json = $this->serialize($company);

            $response = new Response($json, 200);

            $response->headers->set('Content-Type', 'application/json');

            return $response;
        }

        $user = $this->getUser();

        $user = [
            'id' => $user->getId(),
            'type' => 'particular',
            'first_name' => $user->getParticular()->getFirstName()
        ];
        $json = $this->serialize($user);

        $response = new Response($json, 200);

        return $response;
    }

    /**
     * Undocumented function
     *
     * @param [type] $companyArray
     * @return bool
     */
    public function verifyCompanyAccountExist($companyArray)
    {
        return !empty($companyArray);
    }
}
