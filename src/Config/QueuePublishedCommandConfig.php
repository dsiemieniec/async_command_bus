<?php

declare(strict_types=1);

namespace App\Config;

class QueuePublishedCommandConfig implements CommandPublisherConfig
{
    public function __construct(
        private Queue $queue
    ) {
    }

    public function getPublisherTarget(): PublisherTarget
    {
        return new PublisherTarget($this->queue->getName());
    }

    public function getConnection(): Connection
    {
        return $this->queue->getConnection();
    }
}
