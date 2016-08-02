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

use MercadoPAgo\Annotations\RoutingTable;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection as AbstractConnection;

/**
 * Doctrine connection for the rest driver
 *
 * @author    Tobias Hauck <tobias@circle.ai>
 * @copyright 2015 TeeAge-Beatz UG
 */
class Connection extends AbstractConnection {

    /**
     * @var Statement
     */
    private $statement;

    /**
     * @var array
     */
    private $routings;

    /**
     * Connection constructor
     *
     * @param array        $params
     * @param Driver       $driver
     * @param RoutingTable $routings
     */
    public function __construct(array $params, Driver $driver, RoutingTable $routings, Configuration $config = null, EventManager $eventManager = null) {
        $this->routings = $routings;
        parent::__construct($params, $driver, $config, $eventManager);
    }

    /**
     * prepares the statement execution
     *
     * @param  string $statement
     * @return Statement
     */
    public function prepare($statement) {
        $this->connect();

        $this->statement = new Statement($statement, $this->getParams(), $this->routings);
        $this->statement->setFetchMode($this->defaultFetchMode);

        return $this->statement;
    }

    /**
     * returns the last inserted id
     *
     * @param  string|null $seqName
     * @return int
     *
     * @SuppressWarnings("PHPMD.UnusedFormalParameter")
     */
    public function lastInsertId($seqName = null) {
        return $this->statement->getId();
    }

    /**
     * Executes a query, returns a statement
     *
     * @return Statement
     */
    public function query() {
        $statement = $this->prepare(func_get_args()[0]);
        $statement->execute();

        return $statement;
    }
}