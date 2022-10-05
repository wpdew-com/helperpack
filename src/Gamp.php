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

    function getReport($analytics) {

        // здесь нужно указать значение своего VIEW_ID
        $VIEW_ID = "ga:277219841"; //335572940  makesite.com.ua
        // создадим объект DateRange (диапазон дат)
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        // установка начальной даты
        $dateRange->setStartDate("7daysAgo"); //  30daysAgo 7daysAgo  https://developers.google.com/analytics/devguides/reporting/core/v3/reference#startDate
        // установка конечной даты
        $dateRange->setEndDate("today");

        // создадим объект Metrics (показатели данных)
        $users = new Google_Service_AnalyticsReporting_Metric();
        $users->setExpression("ga:users");
        $users->setAlias("users");

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
