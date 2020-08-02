<?php

namespace App;

/**
 * Class ArticleAggregator
 */
class ArticleAggregator implements \Iterator
{
    /**@var ConnectorInterface[] */
    private array $connectorList = [];
    /** @var int  */
    private int $currentConnectorIndex = 0;
    /** @var int  */
    private int $currentRowIndex = 0;
    /** @var array  */
    private array $currentData = [];

    /**
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     */
    public function appendDatabase(string $host, string $dbname, string $user, string $password)
    {
        $this->connectorList[] = new DatabaseConnector($host, $dbname, $user, $password);
    }

    /**
     * @param string $name
     * @param string $feedUrl
     */
    public function appendRss(string $name, string $feedUrl)
    {
        $this->connectorList[] = new RssFeedConnector($name, $feedUrl);
    }

    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->currentData[$this->currentRowIndex];

    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->currentRowIndex++;
    }

    /**
     * {@inheritDoc}
     */
    public function key()
    {
        return $this->currentRowIndex;
    }

    /**
     * {@inheritDoc}
     */
    public function valid()
    {
        if (isset($this->currentData[$this->currentRowIndex])) {
            return true;
        }

        //If in row, no data was found, try on next connector
        if ($this->currentRowIndex > 0) {
            $this->currentConnectorIndex++;
            $this->currentRowIndex = 0;
            $this->currentData = [];
        }

        //Do a fetch all only once by connector
        if (0 === $this->currentRowIndex && isset($this->connectorList[$this->currentConnectorIndex])) {
            $this->currentData = $this->connectorList[$this->currentConnectorIndex]->fetchAll();
        }

        return isset($this->currentData[$this->currentRowIndex]);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->currentConnectorIndex = 0;
        $this->currentRowIndex = 0;
        $this->currentData = [];
    }
}