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

namespace MercadoPago;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Provider for doctrine meta data
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class MetaData {

    /**
     * MetaDataProvider constructor
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function __construct() {
        //AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'Annotations' . DIRECTORY_SEPARATOR . 'Insert.php');
        //AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'Annotations' . DIRECTORY_SEPARATOR . 'Update.php');
        //AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'Annotations' . DIRECTORY_SEPARATOR . 'Select.php');
        AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'Annotations' . DIRECTORY_SEPARATOR . 'Fetch.php');
        //AnnotationRegistry::registerFile(__DIR__ . DIRECTORY_SEPARATOR . 'Annotations' . DIRECTORY_SEPARATOR . 'Delete.php');
    }

    /**
     * returns all namespaces of managed entities
     *
     * @return array
     */
    public function getEntityNamespaces() {
        $meta = $this->getMetaData(debug_backtrace());

        return array_reduce($meta, function($carry, $item) {
            $carry[$item->table['name']] = $item->getName();
            return $carry;
        }, []);
    }

    /**
     * returns all entity meta data if existing
     *
     * @param  array $traces
     * @return array
     */
    private function getMetaData(array $traces) {
        $em = array_filter($traces, function($trace) {
            return isset($trace['object']) && $trace['object'] instanceof ObjectManager;
        });

        return empty($em) ? [] : array_pop($em)['object']->getMetaDataFactory()->getAllMetaData();
    }
}