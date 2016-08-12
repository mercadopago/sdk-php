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

use MercadoPago\Annotations\RoutingTable;
use Doctrine\DBAL\Driver as DriverInterface;
use Doctrine\DBAL\Connection as AbstractConnection;
use Doctrine\DBAL\Platforms\MySqlPlatform;
use Doctrine\DBAL\Schema\MySqlSchemaManager;

/**
 * Rest driver class
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class Driver implements DriverInterface {

    /**
     * @var Connection
     */
    private $connection;

    /**
     * {@inheritdoc}
     *
     * @SuppressWarnings("PHPMD.StaticAccess")
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = array()) {
        if (!empty($this->connection)) return $this->connection;

        $metaData         = new MetaData();
        $this->connection = new Connection($params, $this, new RoutingTable($metaData->getEntityNamespaces()));
        return $this->connection;
    }

    /**
     * {@inheritdoc}
     */
    public function getDatabasePlatform() {
        return new MySqlPlatform();
    }

    /**
     * {@inheritdoc}
     */
    public function getSchemaManager(AbstractConnection $conn) {
        return new MySqlSchemaManager($conn);
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'circle_rest';
    }

    /**
     * {@inheritdoc}
     */
    public function getDatabase(AbstractConnection $conn) {
        return 'rest_database';
    }
}