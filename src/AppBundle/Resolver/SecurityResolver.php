<?php

namespace AppBundle\Resolver;

use AppBundle\Resolver\AbstractResolver;

class SecurityResolver extends AbstractResolver {

    public function authentificate($token) {
        $hash = hash("SHA512", $token);
        
        $auth = $this->em->getRepository('AppBundle:Security')->findOneBy(array('token' => $hash));

        if (!$auth) {
            throw $this->createInvalidAuthentificationException();
        }

        return $this->container->get('resolver.token')->generateToken();
    }

}
