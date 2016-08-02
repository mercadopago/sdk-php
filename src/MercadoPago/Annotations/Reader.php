<?php
/**
 * This file is part of DoctrineRestDriver.
 *
 * DoctrineRestDriver is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * DoctrineRestDriver is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DoctrineRestDriver.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace MercadoPago\Annotations;

use Doctrine\Common\Annotations\AnnotationReader;

/**
 * Reads annotations
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class Reader {

    /**
     * @var AnnotationReader
     */
    private $annotationReader;

    /**
     * Reader constructor.
     */
    public function __construct() {
        $this->annotationReader = new AnnotationReader();
    }

    /**
     * returns the route annotation value or null if no annotation exists
     *
     * @param  \ReflectionClass  $class
     * @param  string $namespace
     * @return null|string
     */
    public function read(\ReflectionClass $class, $namespace) {
        $annotation = $this->annotationReader->getClassAnnotation($class, $namespace);

        return $annotation instanceof $namespace ? $annotation->getRoute() : null;
    }
}