<?php

namespace App\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * @Annotation
 *
 * @Target("CLASS")
 *
 * Class UserAware
 *
 * @package App\Annotation
 */
final class UserAware
{
    public $userFieldName;
}