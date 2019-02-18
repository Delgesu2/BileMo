<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * Class Password
 *
 * @package App\Validator\Constraints
 *
 * @Annotation
 */
class Password extends Constraint
{
    public $message = 'Mot de passe invalide. Un mot de passe doit contenir au moins 8 caractères,
     1 majuscule et 1 chiffre';
}