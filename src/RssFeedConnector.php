<?php

namespace App;

/**
 * Class RssFeedConnector
 */
final class RssFeedConnector implements ConnectorInterface
{
    /** @var string  */
    private string $sourceName;
    /** @var string  */
    private string $feedUrl;

    /**
     * @param string $sourceName
     * @param string $feedUrl
     */
    public function __construct(string $sourceName, string $feedUrl)
    {
        $this->sourceName = $sourceName;
        $this->feedUrl = $feedUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAll(): array
    {
        $rssData = simplexml_load_file($this->feedUrl);

        if (false === $rssData) {
            //Log error
            return [];
        }

        $articles = [];
        /** @var \SimpleXMLElement $rssNode */
        foreach ($rssData->{'channel'}->{'item'} as $rssNode) {
            $articles[] = new ArticleModel($rssNode->{'title'}, $this->sourceName, $rssNode->{'description'});
        }

        return $articles;
    }
}