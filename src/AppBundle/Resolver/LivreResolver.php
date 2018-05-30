<?php

namespace AppBundle\Resolver;

use AppBundle\Resolver\AbstractResolver;

class LivreResolver extends AbstractResolver {

    public function findAll() {
        return $this->em->getRepository('AppBundle:Livre')->findAll();
    }

    public function find($id) {
        $livre = $this->em->getRepository('AppBundle:Livre')->find($id);

        if (!$livre) {
            throw $this->createNotFoundException();
        }

        return $livre;
    }

}
