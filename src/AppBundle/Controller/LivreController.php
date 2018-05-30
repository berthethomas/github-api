<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Livre;

class LivreController extends Controller {

    /**
     * @Route("/livre/add", name="livre_add", methods={"POST"})
     */
    public function indexAction(Request $request) {
        $data = $request->request->all();


        if (array_key_exists('titre', $data) && array_key_exists('date_parution', $data) && array_key_exists('genre', $data) && array_key_exists('prix', $data) && array_key_exists('auteur_id', $data)) {
            if ($data['titre'] !== NULL && $data['date_parution'] !== NULL && $data['genre'] !== NULL && $data['prix'] !== NULL && $data['auteur_id'] !== NULL) {
                $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Auteur');
                $auteur = $repository->find($data['auteur_id']);
                
                if($auteur == NULL) {
                    return new Response("Id ".$data['auteur_id'] . " for auteur does'nt exist");
                }
                
                $titre = $data['titre'];
                $date_parution = $data['date_parution'];
                $genre = $data['genre'];
                $prix = $data['prix'];

                $livre = new Livre();
                $livre->setTitre($titre);
                $livre->setGenre($genre);
                $livre->setPrix($prix);
                $livre->setAuteur($auteur);

                $date_parution = \DateTime::createFromFormat("Y-m-d", $date_parution);
                $date_parution->setTime(0, 0, 0);

                $livre->setDateParution($date_parution);

                $em = $this->getDoctrine()->getManager();
                $em->persist($livre);
                $em->flush();

                return new Response("OK");
            }
        }

        return new Response("Missing parameters");
    }

}
