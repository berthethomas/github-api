<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class Request {

    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function generateCurlRequest($query) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://api.github.com/graphql");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = "Authorization: bearer " . $this->container->getParameter('github_token');
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        $headers[] = 'User-Agent: PHP Script';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);


        return $result;
    }

}
