<?php
/*
 * Fusio
 * A web-application to create dynamically RESTful APIs
 *
 * Copyright (C) 2015-2020 Christoph Kappestein <christoph.kappestein@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Fusio\Adapter\Hadoop\Connection;

use Fusio\Engine\ConnectionInterface;
use Fusio\Engine\Form\BuilderInterface;
use Fusio\Engine\Form\ElementFactoryInterface;
use Fusio\Engine\ParametersInterface;

/**
 * Impala
 *
 * @author  Christoph Kappestein <christoph.kappestein@gmail.com>
 * @license http://www.gnu.org/licenses/agpl-3.0
 * @link    http://fusio-project.org
 */
class Impala implements ConnectionInterface
{
    public function getName()
    {
        return 'Impala';
    }

    /**
     * @param \Fusio\Engine\ParametersInterface $config
     * @return \ThriftSQL\Impala
     */
    public function getConnection(ParametersInterface $config)
    {
        $host = $config->get('host');
        $port = $config->get('port');
        if (empty($port)) {
            $port = 21000;
        }

        $username = $config->get('username') ?: null;
        $password = $config->get('password') ?: null;

        return new \ThriftSQL\Impala($host, $port, $username, $password);
    }

    public function configure(BuilderInterface $builder, ElementFactoryInterface $elementFactory)
    {
        $builder->add($elementFactory->newInput('host', 'Host', 'text', 'The hostname'));
        $builder->add($elementFactory->newInput('port', 'Port', 'text', 'Optional the port (default is 21000)'));
        $builder->add($elementFactory->newInput('username', 'Username', 'text', 'Optional username for authentication'));
        $builder->add($elementFactory->newInput('password', 'Password', 'text', 'Optional password for authentication'));
    }
}
