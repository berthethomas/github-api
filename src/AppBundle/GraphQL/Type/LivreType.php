<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\DateTimeType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\FloatType;
use Youshido\GraphQL\Type\NonNullType;
use AppBundle\GraphQL\Type\AuteurType;

class LivreType extends AbstractObjectType {

    public function build($config) { 
        $config
                ->addField('id', new NonNullType(new IdType()))
                ->addField('titre', new StringType())
                ->addField('genre', new StringType())
                ->addField('prix', new FloatType())
                ->addField('date_parution', new DateTimeType())
                ->addField('auteur', new AuteurType());
    }

    public function getName() {
        return "Livre";
    }

}
