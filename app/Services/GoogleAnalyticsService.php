<?php

namespace App\Services;

use Spatie\Analytics\Period;
use Illuminate\Support\Carbon;
use Spatie\Analytics\Analytics;

class GoogleAnalyticsService
{
    public static function getCities($filter)
    {
        $cities = [];
        $cityResponse = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:city,ga:sessions',
            [
                'metrics' => 'ga:users',
                'dimensions' => 'ga:city',
                'filters' => $filter
            ]
        );
        if (isset($cityResponse['rows'])) {
            foreach ($cityResponse['rows'] as $row) {
                $cities[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }
        return $cities;
    }


    public static function getAges($filter)
    {
        $ages = [];
        $age_response = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:userAgeBracket',
            ['metrics' => 'ga:sessions', 'dimensions' => 'ga:userAgeBracket', 'filters' => $filter]
        );

        if (isset($age_response['rows'])) {
            foreach ($age_response['rows'] as $row) {
                $ages[] = ['value' => $row[0], 'visitors_number' => $row[1]];
            };
        }
        return $ages;
    }

    public static function getCountries($filter)
    {

        $countries = [];
        $countryResponse = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:country',
            ['metrics' => 'ga:sessions', 'dimensions' => 'ga:country', 'filters' => $filter]
        );
        if (isset($countryResponse['rows'])) {
            foreach ($countryResponse['rows'] as $row) {
                $countries[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }
        return $countries;
    }


    public static function getGenders($filter)
    {
        $genders = [];
        $genderResponse = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:userGender',
            ['metrics' => 'ga:sessions', 'dimensions' => 'ga:userGender', 'filters' => $filter]
        );
        if (isset($genderResponse['rows'])) {
            foreach ($genderResponse['rows'] as $row) {
                $genders[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        return $genders;
    }

    public static function getTargetedAudience($filter)
    {
        $interests = [];
        $interestResponse = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:interestAffinityCategory',
                'filters' => $filter,
            ]
        );

        if (isset($interestResponse['rows'])) {
            foreach ($interestResponse['rows'] as $row) {
                $interests[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        $otherCategories = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:interestOtherCategory',
                'filters' => $filter,
            ]
        );

        if (isset($otherCategories['rows'])) {
            foreach ($otherCategories['rows'] as $row) {
                $interests[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        $marketCategories = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:interestInMarketCategory',
                'filters' => $filter,
            ]
        );

        if (isset($marketCategories['rows'])) {
            foreach ($marketCategories['rows'] as $row) {
                $interests[] = [
                    'value' => $row[0],
                    'visitors_number' => $row[1],
                ];
            };
        }

        return $interests;
    }

    public static function getAdOperatingSystems($filter)
    {
        $operatingSystemData = [];
        $operatingSystem = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:operatingSystem',
                'filters' => $filter,
            ]
        );

        if (isset($operatingSystem['rows'])) {
            foreach ($operatingSystem['rows'] as $row) {
                $operatingSystemData[] = [
                    'key' => 'operating_system',
                    'name' => $row[0],
                    'count' => $row[1]
                ];
            }
        }
        return $operatingSystemData;
    }

    public static function getAdBrowsers($filter)
    {
        $browsersData = [];
        $browsers = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:browser',
                'filters' => $filter,
            ]
        );

        if (isset($browsers['rows'])) {
            foreach ($browsers['rows'] as $row) {
                $browsersData[] = [
                    'key' => 'browsers',
                    'name' => $row[0],
                    'count' => $row[1]
                ];
            }
        }
        return $browsersData;
    }

    public static function getAdDevices($filter)
    {
        $devicesData = [];
        $devices = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:sessions',
            [
                'dimensions' => 'ga:deviceCategory',
                'filters' => $filter,
            ]
        );

        if (isset($devices['rows'])) {
            foreach ($devices['rows'] as $row) {
                $devicesData[] = [
                    'key' => 'devices',
                    'name' => $row[0],
                    'count' => $row[1]
                ];
            }
        }
        return $devicesData;
    }


    public static function getTimeForAd($filter)
    {
        $timeResponse = app(Analytics::class)->performQuery(
            Period::create(Carbon::now()->subYear(), now()),
            'ga:pagePath',
            ['metrics' => 'ga:timeOnPage', 'dimensions' => 'ga:pagePath', 'filters' => $filter]
        );
        $time =0;
        foreach ($timeResponse['rows'] as $row){
            $time +=$row[1];
        }
        return $time;
    }
}
