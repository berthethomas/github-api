<?php

namespace AppBundle\GraphQL\Type;

use Youshido\GraphQL\Type\Object\AbstractObjectType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQL\Type\Scalar\FloatType;
use Youshido\GraphQL\Type\NonNullType;

class CommentaireType extends AbstractObjectType {

    public function build($config) { 
        $config
                ->addField('id', new NonNullType(new IdType()))
                ->addField('texte', new StringType())
                ->addField('note', new FloatType());
    }

    public function getName() {
        return "Commentaire";
    }

}
