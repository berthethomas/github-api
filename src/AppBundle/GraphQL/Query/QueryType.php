<?php

namespace AppBundle\GraphQL\Query;

use AppBundle\GraphQL\Query\Auteur\AuteursField;
use AppBundle\GraphQL\Query\Auteur\FindAuteurField;
use Youshido\GraphQL\Config\Object\ObjectTypeConfig;
use Youshido\GraphQL\Type\Object\AbstractObjectType;
use AppBundle\GraphQL\Query\Livre\LivresField;
use AppBundle\GraphQL\Query\Livre\FindLivreField;

class QueryType extends AbstractObjectType {

    /**
     * @param ObjectTypeConfig $config
     *
     * @return mixed
     */
    public function build($config) {
        $config->addFields([
            new AuteursField(),
            new FindAuteurField(),
            new LivresField(),
            new FindLivreField()
        ]);
    }

}
