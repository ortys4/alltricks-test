<?php

namespace App;

/**
 * Class ArticleModel
 */
class ArticleModel implements ArticleInterface
{
    /** @var string */
    private string $name;

    /** @var string */
    private string $sourceName;

    /** @var string */
    private string $content;

    /**
     * @param string $name
     * @param string $sourceName
     * @param string $content
     */
    public function __construct(string $name, string $sourceName, string $content)
    {
        $this->name = $name;
        $this->sourceName = $sourceName;
        $this->content = $content;
    }

    /**
     * {@inheritDoc}
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function getSourceName(): string
    {
        return $this->sourceName;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent(): string
    {
        return $this->content;
    }
}