<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\DateTimeType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\ListType\ListType;

class AuteurType extends AbstractObjectType {

    public function build($config) {
        $config
                ->addField('id', new NonNullType(new IdType()))
                ->addField('nom', new StringType())
                ->addField('prenom', new StringType())
                ->addField('date_naissance', new DateTimeType())
                ->addField('livres', new ListType(new LivreType()));
    }

    public function getName() {
        return "Auteur";
    }

}
