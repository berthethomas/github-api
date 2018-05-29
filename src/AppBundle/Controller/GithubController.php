<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\Request as Service;

class GithubController extends Controller {

    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request) {
        $request = array(
            'query' => 'query { viewer { login }}'
        );

        $json = json_encode($request);

        return $this->service->generateCurlRequest($json);
    }

}
