<?php

namespace Wpdew\HelperPack;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

class Ga4
{

    function getReport($getdata) {

        $property_id = config("wpdew.MEASUREMENT_ID");
        $path = config("wpdew.GOOGLE_APPLICATION_CREDENTIALS"); 
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
        $client = new BetaAnalyticsDataClient();

        // Make an API call.
        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $getdata['start_date'], // '2020-01-01' 
                    'end_date' => $getdata['end_date'], // 'today'
                ]),
            ],
            'metrics' => [new Metric(
                [
                    'name' => $getdata['metric'], // 'activeUsers' 
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