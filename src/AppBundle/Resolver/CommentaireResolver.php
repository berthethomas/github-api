<?php

namespace AppBundle\Resolver;

use AppBundle\Resolver\AbstractResolver;
use AppBundle\Entity\Commentaire;

class CommentaireResolver extends AbstractResolver {
    
    public function add($texte, $note, $livre_id) {
        $repository = $this->em->getRepository('AppBundle:Livre');
        $livre = $repository->find($livre_id);

        if (!$livre) {
            throw $this->createNotFoundException();
        }
        
        $commentaire = new Commentaire();
        $commentaire->setTexte($texte);
        $commentaire->setNote($note);
        $commentaire->setLivre($livre);
        
        $this->em->persist($commentaire);
        $this->em->flush();

        return $livre;
    }

}
