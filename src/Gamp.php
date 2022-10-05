<?php

namespace Wpdew\HelperPack;

use Google_Client;
use Google_Service;
use Google_Service_Analytics;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_GetReportsRequest;

class Gamp
{
    

    function initializeAnalytics()
    {

      // здесь нужно указать имя JSON-файла, содержащего сгенерированный ключ
      $KEY_FILE_LOCATION = config("wpdew.KEY_FILE_LOCATION");//public_path() . '/google/analytics.json';

      // Создание и конфигурирование нового клиентского объекта.
      $client = new Google_Client();
      $client->setApplicationName("Top pages");
      $client->setAuthConfig($KEY_FILE_LOCATION);
      $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
      $analytics = new Google_Service_AnalyticsReporting($client);


      return $analytics;
    }

    /**
     * data array
     * 
     * setStartDate
     * setEndDate
     * setExpression
     * setAlias
     *
     * @return $analytics->reports->batchGet( $body );
     */
  

    function getReport($analytics , $data) {

        // здесь нужно указать значение своего VIEW_ID
        $VIEW_ID = config("wpdew.VIEW_ID");//"ga:xxxxxxxxx"; 
        // создадим объект DateRange (диапазон дат)
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        // установка начальной даты
        $dateRange->setStartDate($data['setStartDate']); // 7daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo
        // установка конечной даты
        $dateRange->setEndDate($data['setEndDate']);// today, yesterday, 7daysAgo, 14daysAgo, 30daysAgo, 90daysAgo, 365daysAgo, 1095daysAgo

        // создадим объект Metrics (показатели данных)
        $users = new Google_Service_AnalyticsReporting_Metric();
        $users->setExpression($data['setExpression']); // ga:pageviews, ga:users, ga:sessions, ga:avgSessionDuration, ga:pageviewsPerSession, ga:avgTimeOnPage, ga:entrances, ga:bounceRate, ga:exitRate, ga:pageValue, ga:uniquePageviews, ga:timeOnPage, ga:exits, ga:entranceRate, ga:searchUniques, ga:searchResultViews, ga:searchSessions, ga:searchRefinements, ga:searchDuration, ga:searchExits, ga:searchExitRate, ga:searchDepth, ga:searchRefinementViews, ga:percentNewSessions, ga:percentNewVisits, ga:goal1Completions, ga:goal1ConversionRate, ga:goal1Value, ga:goal1Abandons, ga:goal1AbandonRate, ga:goal2Completions, ga:goal2ConversionRate, ga:goal2Value, ga:goal2Abandons, ga:goal2AbandonRate, ga:goal3Completions, ga:goal3ConversionRate, ga:goal3Value, ga:goal3Abandons, ga:goal3AbandonRate, ga:goal4Completions, ga:goal4ConversionRate, ga:goal4Value, ga:goal4Abandons, ga:goal4AbandonRate, ga:goal5Completions, ga:goal5ConversionRate, ga:goal5Value, ga:goal5Abandons, ga:goal5AbandonRate, ga:goal6Completions, ga:goal6ConversionRate, ga:goal6Value, ga:goal6Abandons, ga:goal6AbandonRate, ga:goal7Completions, ga:goal7ConversionRate, ga:goal7Value, ga:goal7Abandons, ga:goal7AbandonRate, ga:goal8Completions, ga:goal8ConversionRate, ga:goal8Value, ga:goal8Abandons, ga:goal8AbandonRate, ga:goal9Completions, ga:goal9ConversionRate, ga:goal9Value, ga:goal9Abandons, ga:goal9AbandonRate, ga:goal10Completions, ga:goal10ConversionRate, ga:goal10Value, ga:goal10
        $users->setAlias($data['setAlias']); // Pageviews, Users, Sessions, Avg. Session Duration, Pages / Session, Avg. Time on Page, Entrances, Bounce Rate, Exit Rate, Page Value, Unique Pageviews, Time on Page, Exits, Entrance Rate, Search Uniques, Search Result Views, Search Sessions, Search Refinements, Search Duration, Search Exits, Search Exit Rate, Search Depth, Search Refinement Views, % New Sessions, % New Visits, Goal 1 Completions, Goal 1 Conversion Rate, Goal 1 Value, Goal 1 Abandons, Goal 1 Abandon Rate, Goal 2 Completions, Goal 2 Conversion Rate, Goal 2 Value, Goal 2 Abandons, Goal 2 Abandon Rate, Goal 3 Completions, Goal 3 Conversion Rate, Goal 3 Value, Goal 3 Abandons, Goal 3 Abandon Rate, Goal 4 Completions, Goal 4 Conversion Rate, Goal 4 Value, Goal 4 Abandons, Goal 4 Abandon Rate, Goal 5 Completions, Goal 5 Conversion Rate, Goal 5 Value, Goal 5 Abandons, Goal 5 Abandon Rate, Goal 6 Completions, Goal 6 Conversion Rate, Goal 6 Value, Goal 6 Abandons, Goal 6 Abandon Rate, Goal 7 Completions, Goal 7 Conversion Rate, Goal 7 Value, Goal 7 Abandons, Goal 7 Abandon Rate, Goal 8 Completions, Goal 8 Conversion Rate, Goal 8 Value, Goal 8 Abandons, Goal 8 Abandon Rate, Goal 9 Completions, Goal 9 Conversion Rate, Goal 9 Value, Goal 9 Abandons, Goal 9 Abandon Rate, Goal 10 Completions, Goal 10 Conversion Rate, Goal 10 Value, Goal 10

        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges($dateRange);
        $request->setMetrics(array($users));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests( array( $request) );
        return $analytics->reports->batchGet( $body );


      }

      function printResults($reports) {
        $content ="";
        for ( $reportIndex = 0; $reportIndex < count( $reports ); $reportIndex++ ) {
          $report = $reports[ $reportIndex ];
          $header = $report->getColumnHeader();
          $dimensionHeaders = $header->getDimensions();
          $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
          $rows = $report->getData()->getRows();

          for ( $rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
            $row = $rows[ $rowIndex ];
            $dimensions = $row->getDimensions();
            $metrics = $row->getMetrics();


            for ($j = 0; $j < count($metrics); $j++) {
              $values = $metrics[$j]->getValues();
              for ($k = 0; $k < count($values); $k++) {
                $entry = $metricHeaders[$k];
                $content .= $values[$k];//users
              }
            }
          }
        }

        return $content;
      }




    public function getName($name)
    {
        return 'Hi from HelperLaravel Class '.$name;
    }
}
