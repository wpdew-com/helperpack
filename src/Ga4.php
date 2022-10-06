<?php

namespace Wpdew\HelperPack;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

class Ga4
{

    function getReport() {

        $property_id = '335572940';
        $path = public_path()."/google/analytics.json";
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
        $client = new BetaAnalyticsDataClient();

        // Make an API call.
        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => '2020-03-31',
                    'end_date' => 'today',
                ]),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'activeUsers',
                ]
            )
            ]
        ]);


        foreach ($response->getRows() as $row) {
            $data = $row->getMetricValues()[0]->getValue();
        }

        return $data;

    }

}