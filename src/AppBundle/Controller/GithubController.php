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
     * @Route("/github", name="github")
     */
    public function indexAction(Request $request) {
        $user = NULL;
        $error = NULL;
        $count = NULL;
        $login = NULL;

        if ($request->request->get('login') !== NULL) {
            $login = $request->request->get('login');
            $count = $this->getCountOfRepositories($login);

            $request = array(
                'query' => 'query($login : String!, $count : Int!) { user(login: $login) { login, email, name, repositories(first: $count) { edges { node { name, createdAt }}}}}',
                'variables' => array(
                    "login" => $login,
                    "count" => $count
                )
            );

            $json = json_encode($request);

            $data = json_decode($this->service->generateCurlRequest($json));

            if ($data->data->user !== NULL) {
                $user = $data->data->user;
            } else {
                $error = "Aucuns résultats trouvé pour l'identifiant : " . $login;
            }
        }

        return $this->render('app/github.html.twig', array('login' => $login, 'user' => $user, 'count' => $count, 'error' => $error));
    }

    private function getCountOfRepositories($login) {
        $request = array(
            'query' => 'query($login : String!) { user(login: $login) { repositories { totalCount }}}',
            'variables' => array(
                "login" => $login
            )
        );

        $json = json_encode($request);

        $response = json_decode($this->service->generateCurlRequest($json));

        if ($response->data->user !== NULL) {
            return $response->data->user->repositories->totalCount;
        } else {
            return 0;
        }
    }

}
