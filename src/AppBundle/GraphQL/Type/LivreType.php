<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\DateTimeType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\FloatType;
use Youshido\GraphQL\Type\NonNullType;
use AppBundle\GraphQL\Type\AuteurType;
use Youshido\GraphQL\Type\ListType\ListType;

class LivreType extends AbstractObjectType {

    public function build($config) { 
        $config
                ->addField('id', new NonNullType(new IdType()))
                ->addField('titre', new StringType())
                ->addField('genre', new StringType())
                ->addField('prix', new FloatType())
                ->addField('date_parution', new DateTimeType())
                ->addField('auteur', new AuteurType())
                ->addField('commentaires', new ListType(new CommentaireType()));
    }

    public function getName() {
        return "Livre";
    }

}
