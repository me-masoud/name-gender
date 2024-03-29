<?php

namespace App\Http\Controllers;

use App\Models\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class NameController extends Controller
{
    public function httpConnectionToNiko($perPage, $pageNumber = 1)
    {
        $baseUrl = 'https://nameniko.com/name/searchname';
        $postRequest = array(
            'name' => '',
            'gender' => '',
            'EnName' => '',
            'meaning' => '',
            'abjad' => '',
            'order' => '',
            'orderby' => '',
            'pageindex' => "$pageNumber",
            'pagesize' => "$perPage",

        );

        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $baseUrl);
        curl_setopt($cURLConnection, CURLOPT_POST, 1);
        curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, http_build_query($postRequest));
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        return $apiResponse;
    }

    public function httpConnectionToNikoNameDetail($link)
    {
        $baseUrl = 'https://nameniko.com';
        $link = $baseUrl . $link;

        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, $link);
        curl_setopt($cURLConnection, CURLOPT_SSL_VERIFYPEER, FALSE);

        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $apiResponse = curl_exec($cURLConnection);
        curl_close($cURLConnection);

        $crawner = new Crawler($apiResponse);

        $details = $crawner->filter('td.r-value'); // description of name
        $gender = $details->eq(0)->text();

        echo $gender;
        $result = [
            'name' => $crawner->filter('h1.name')->text(),
            'persian_pronounce' => $details->eq(3)->text(),
            'en_name' => $details->eq(1)->text(),
            'en_pronounce' => $details->eq(5)->text(),
            'gender' => str_contains($gender, 'پسر') ? 'male' : 'female',
            'description' => $crawner->filter('div.meaning')->text(),
            'popularity' => $details->eq(2)->text(),
            'abjad' => $details->eq(4)->text(),
//            'nationality' => $details->eq(6)->text() ?? null,
            'confirm' => 1
        ];

        return $result;
    }

    public function getNamesListOfNamesFromNiko()
    {
        $perPage = 69;
        for ($i = 1; $i < 200; $i++) {
            echo "Start page $i \n";
            $apiResponse = $this->httpConnectionToNiko($perPage, $i);
            $crawler = new Crawler($apiResponse);
            $persianNames = $crawler->filter('a.name-value');
            for ($j = 0; $j < $perPage; $j++) {
                $nameLink = $persianNames->eq($j)->extract(['href'])[0];
                $name = $persianNames->eq($j)->text();
                echo "Name : $name \n";
                if (!Name::where('name', $name)->exists()) {
                    $result = $this->httpConnectionToNikoNameDetail($nameLink);
                    if ($result) {
                        Name::create($result);
                    }
                }

            }
        }
    }

    public function getANameDetails($name)
    {
        $name = urldecode($name);
        return Name::where('name', $name)->orWhere('en_name', $name)
            ->where('confirm', true)
            ->first([
                'name',
                'persian_pronounce',
                'en_name',
                'en_pronounce',
                'gender',
                'nationality',
                'description',
                'abjad',
                'popularity',
            ]);
    }

    public function insertName(Request $request)
    {
        $validation = $request->validate(
            [
                'name' => 'required|max:50|min:2|string',
                'persian_pronounce' => 'max:100|min:2|string',
                'en_name' => 'max:50|min:2|string',
                'en_pronounce' => 'max:100|min:2|string',
                'gender' => 'in:male,female,both',
                'nationality' => 'max:50|min:2|string',
                'description' => 'max:500|min:2|string',
                'abjad' => 'numeric',
                'popularity' => 'numeric',
            ]
        );

        if (!Name::where('name', $request->name)->exists()) {
            Name::create([
                'name' => $request->name,
                'persian_pronounce' => $request->persian_pronounce,
                'en_name' => $request->en_name,
                'en_pronounce' => $request->en_pronounce,
                'gender' => $request->gender,
                'nationality' => $request->nationality,
                'description' => $request->description,
                'abjad' => $request->abjad,
                'popularity' => $request->popularity,
                'confirm' => 0
            ]);
        } else {
            return response()->json('the name already exists', 422);
        }
    }
}
