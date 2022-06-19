<?php

use Elasticsearch\ClientBuilder;

const INDEX = 'pns';

$elasticsearchConnection = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();