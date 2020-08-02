<?php

namespace App;

/**
 * All connector must be implement this interface
 */
interface ConnectorInterface
{
    /**
     * @return ArticleInterface[]
     */
    public function fetchAll(): array;
}