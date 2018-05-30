<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Auteur;

class AuteurController extends Controller {

    /**
     * @Route("/rest/auteur/add", name="auteur_add", methods={"POST"})
     */
    public function indexAction(Request $request) {
        $data = $request->request->all();


        if (array_key_exists('nom', $data) && array_key_exists('prenom', $data) && array_key_exists('date_naissance', $data)) {
            if ($data['nom'] !== NULL && $data['prenom'] !== NULL && $data['date_naissance'] !== NULL) {
                $nom = $data['nom'];
                $prenom = $data['prenom'];
                $date_naissance = $data['date_naissance'];

                $auteur = new Auteur();
                $auteur->setNom($nom);
                $auteur->setPrenom($prenom);

                $date_naissance = \DateTime::createFromFormat("Y-m-d", $date_naissance);
                $date_naissance->setTime(0, 0, 0);

                $auteur->setDateNaissance($date_naissance);

                $em = $this->getDoctrine()->getManager();
                $em->persist($auteur);
                $em->flush();

                return new Response("OK");
            }
        }

        return new Response("Missing parameters");
    }

}
