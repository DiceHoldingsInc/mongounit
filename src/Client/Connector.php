<?php

namespace Zumba\PHPUnit\Extensions\Mongo\Client;
use Zumba\PHPUnit\Extensions\Mongo\Base\Connector as BaseConnector;

/**
 * Class Connector
 * @package Zumba\PHPUnit\Extensions\Mongo\Client
 */
class Connector implements BaseConnector {

	/**
	 * Holds the mongo client connection.
	 *
	 * @var \MongoDB\Client
	 */
	protected $connection;

	/**
	 * Array of collection objects keyed by collection name
	 *
	 * @var array
	 */
	protected $collections;

	/**
	 * The db name this connector should work off
	 *
	 * @var string
	 */
	protected $dbName = 'test';

	/**
	 * Constructor
	 */
	public function __construct(\MongoDB\Client $connection) {
		$this->connection = $connection;
	}

	/**
	 * Retrieves a connection.
	 *
	 * @return \MongoClient
	 */
	public function getConnection() {
		return $this->connection;
	}

	/**
	 * Sets the DB name to be acted upon.
	 *
	 * @param string $name
	 */
	public function setDb($name = 'test') {
		$this->dbName = $name;
	}

	/**
	 * Retrieves a collection object by name.
	 *
	 * @param string $name
	 * @return \MongoCollection
	 */
	public function collection($name) {
		if (empty($this->collections[$name])) {
			$this->collections[$name] = new \MongoDB\Collection(
				$this->connection->getManager(),
				$this->connection->selectDatabase($this->dbName),
				$name
			);
		}
		return $this->collections[$name];
	}

}
