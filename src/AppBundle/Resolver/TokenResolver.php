<?php

namespace AppBundle\Resolver;

use AppBundle\Resolver\AbstractResolver;
use AppBundle\Entity\Token;

class TokenResolver extends AbstractResolver {

    public function generateToken() {
        $token = new Token();
        
        $creation = new \DateTime();
        $expiration = new \DateTime();
        $expiration->modify('+ 1 day');
        
        $token->setDateCreation($creation);
        $token->setDateExpiration($expiration);
        $token->setToken(uniqid());
        
        $this->em->persist($token);
        $this->em->flush();        
        
        return $token->getToken();
    }

}
