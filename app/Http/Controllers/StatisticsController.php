<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;


class StatisticsController extends Controller
{
    public function list()
    {

        $TotaluserCount = User::count();
        $TotalNotUserVerifiedCount = User::where('email_verified_at','=', NULL)->count();
        $TotalUserVerifiedCount = User::where('email_verified_at','!=', NULL)->count();

        $Userchart = (new LarapexChart)->setDataset([
            $TotalUserVerifiedCount,
            $TotalNotUserVerifiedCount
        ])
            ->setLabels(['Confirmés', 'Non confirmés'])
            ->setType('pie');


        $TotalresourcesCount = Resource::withoutGlobalScope('no_deleted')->count();
        $VerifiedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('validated', 1)->where('deleted', 0)->count();
        $NotVerifiedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('validated', 0)->where('deleted', 0)->count();
        $DeletedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('deleted', 1)->count();

        $Resourcechart = (new LarapexChart)->setDataset([
                $VerifiedresourcesCount,
                $DeletedresourcesCount,
                $NotVerifiedresourcesCount
            ])
            ->setLabels(['Validées', 'Supprimées', 'Non Validées'])
            ->setType('pie');


        return view('back.statistics.list', [
            // User
            'UserTotalCount' => $TotaluserCount,
            'UserVerifiedCount' => $TotalUserVerifiedCount,
            'UserNotVerifiedCount' => $TotalNotUserVerifiedCount,
            'Userchart' => $Userchart,
            // Resources
            'ResourceTotalCount' => $TotalresourcesCount,
            'ResourceVerifiedCount' => $VerifiedresourcesCount,
            'ResourceNotVerifiedCount' => $NotVerifiedresourcesCount,
            'ResourcesDeletedCount' => $DeletedresourcesCount,
            'Resourcechart' => $Resourcechart,
        ]);
    }
}
