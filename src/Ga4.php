<?php

namespace Wpdew\HelperPack;

use Google\Analytics\Data\V1beta\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Dimension;
use Google\Analytics\Data\V1beta\Metric;

class Ga4
{

    //https://developers.google.com/analytics/devguides/reporting/data/v1/api-schema#metrics
    function getMetriks($getdata) {

        $property_id = config("wpdew.MEASUREMENT_ID");
        $path = config("wpdew.GOOGLE_APPLICATION_CREDENTIALS"); 
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
        $client = new BetaAnalyticsDataClient();

        // Make an API call.
        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $getdata['start_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                    'end_date' => $getdata['end_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                ]),
            ],
            'metrics' => [new Metric(
                [
                    'name' => $getdata['metric'], // activeUsers, newUsers, sessions, totalUsers, screenPageViews
                ]
            )
            ]
        ]);


        foreach ($response->getRows() as $row) {
            $data = $row->getMetricValues()[0]->getValue();
        }

        return $data;

    }


    
    function phpgetMetriks($getdata) {

        $property_id = $_ENV['MEASUREMENT_ID'];
        $path = $_ENV['GOOGLE_APPLICATION_CREDENTIALS']; 
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
        $client = new BetaAnalyticsDataClient();

        // Make an API call.
        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $getdata['start_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                    'end_date' => $getdata['end_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                ]),
            ],
            'metrics' => [new Metric(
                [
                    'name' => $getdata['metric'], // activeUsers, newUsers, sessions, totalUsers, screenPageViews
                ]
            )
            ]
        ]);


        foreach ($response->getRows() as $row) {
            $data = $row->getMetricValues()[0]->getValue();
        }

        return $data;

    }

    
    function FullParamMetriks($getdata) {
        $property_id = $_ENV['MEASUREMENT_ID'];
        $path = $_ENV['GOOGLE_APPLICATION_CREDENTIALS']; 
        putenv("GOOGLE_APPLICATION_CREDENTIALS=$path");
        $client = new BetaAnalyticsDataClient();


        $response = $client->runReport([
            'property' => 'properties/' . $property_id,
            'dateRanges' => [
                new DateRange([
                    'start_date' => $getdata['start_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                    'end_date' => $getdata['end_date'], // 'YYYY-MM-DD', today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
                ]),
            ],
            'metrics' => [new Metric(
                [
                    'name' => 'activeUsers', //$getdata['metric'], // activeUsers, newUsers, sessions, totalUsers, screenPageViews
                    //'name' => 'screenPageViews',
                ]
                ),new Metric(
                [
                    //'name' => $getdata['metric'], // activeUsers, newUsers, sessions, totalUsers, screenPageViews
                    'name' => 'screenPageViews',
                ]
            )
            ],
            'dimensions' => [
                //new Dimension(
                //    [
                //        'name' => 'browser', 
                //    ]),
                new Dimension(
                    [
                        'name' => 'date',
                    ]),
                //new Dimension(
                //    [
                //        'name' => 'deviceCategory',
                //    ])
            ],
            'limit' => 100,
        ]);
        //$data = "";
        //metricAggregations 


        
        foreach ($response->getRows() as $row) {
            //$data = $row->getMetricValues()[0]->getValue();
            // get browser
       // $data = $row->getdimensionValues()[0];
            //foreach create array and sort by date

            //$row arra sort by date
            $data[] = array(
                'date' => $row->getDimensionValues()[0]->getValue(),
                //'browser' => $row->getDimensionValues()[0]->getValue(),
                //'deviceCategory' => $row->getDimensionValues()[2]->getValue(),
                'activeUsers' => $row->getMetricValues()[0]->getValue(),
                'screenPageViews' => $row->getMetricValues()[1]->getValue(),
            );




            
        }

        return $data;

    }


}