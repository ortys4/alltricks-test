<?php

namespace App;

/**
 * All Article must implement this interface
 */
interface ArticleInterface
{
    /** @return string */
    public function getName(): string;

    /** @return string */
    public function getSourceName(): string;

    /** @return string */
    public function getContent(): string;
}