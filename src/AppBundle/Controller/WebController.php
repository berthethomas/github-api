<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Livre;

class WebController extends Controller {

    /**
     * @Route("/graphql", name="graphql_homepage", methods={"GET"})
     */
    public function indexAction(Request $request) {
        return $this->render('app/index.html.twig');
    }

}
