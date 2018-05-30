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

    public function checkTokenAuthentification() {
        $request = $this->container->get('request_stack')->getCurrentRequest();

        if ($request->headers->get('token')) {
            $token = $request->headers->get('token');

            $check = $this->em->getRepository('AppBundle:Token')->findOneBy(array('token' => $token));

            $now = new \DateTime();

            if ($check !== NULL) {
                if ($check->getDateExpiration()->format('YmdHis') >= $now->format('YmdHis')) {
                    return TRUE;
                } else {
                    throw $this->createInvalidAuthentificationException("You're token has expired. Please generate a new token");
                }
            } else {
                throw $this->createInvalidAuthentificationException("Token you're trying to use is invalid");
            }
        }

        throw $this->createInvalidAuthentificationException("Token not found in header request");
    }

}
