<?php

namespace App;

/**
 * Class DatabaseConnector
 */
final class DatabaseConnector implements ConnectorInterface
{
    /** @var \PDO  */
    private \PDO $connection;
    /** @var string  */
    private string $host;
    /** @var string  */
    private string $dbname;
    /** @var string  */
    private string $user;
    /** @var string  */
    private string $password;

    /**
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $dbname, string $user, string $password)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAll(): array
    {
        if(false === $this->connect()) {
            return [];
        }

        $query = <<<SQL
SELECT source.name as SourceName, article.name as Name, article.content as Content
FROM article
JOIN source ON article.source_id = source.id
SQL;
        $articles = [];
        foreach ($this->connection->query($query) as $row) {
            $articles[] = new ArticleModel($row['Name'], $row['SourceName'], $row['Content']);
        }

        return $articles;
    }

    /**
     * @return bool
     */
    private function connect()
    {
        try {
            $this->connection = new \PDO(sprintf('mysql:host=%s;dbname=%s', $this->host, $this->dbname), $this->user, $this->password);

            return true;
        } catch (\Throwable $ex) {
            //Log error
            return false;
        }
    }
}