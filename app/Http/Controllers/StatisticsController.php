<?php

namespace App\Http\Controllers;

use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class StatisticsController extends Controller
{
    public function list()
    {

        $TotaluserCount = User::count();
        $TotalverifiedCount = User::where('email_verified_at','!=', NULL)->count();

        $chart = (new LarapexChart)->setDataset([$TotaluserCount-$TotalverifiedCount, $TotalverifiedCount])
            ->setLabels(['Enregistrés', 'Confirmés']);

        return view('back.statistics.list', ['TotalCount' => $TotaluserCount, 'VerifiedCount' => $TotalverifiedCount, 'chart' => $chart] );
    }
}
