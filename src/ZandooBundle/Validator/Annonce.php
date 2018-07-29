<?php
namespace ZandooBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 */
class Annonce extends Constraint
{
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return AnnonceValidator::class;
        return 'zandoo.annonce_validator';
    }
}

