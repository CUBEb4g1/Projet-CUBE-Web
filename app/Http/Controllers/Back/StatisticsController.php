<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
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
            ->setType('pie')
            ->setHeight('200');


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
            ->setType('pie')
            ->setHeight('200');

        $AllDate = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date')
            ->whereRaw("created_at LIKE '%".now()->year."%'")
            ->groupByRaw('date')
            ->get();


        $RegisterCountByDate = [];
        $i = 0;

        foreach ($AllDate->all() as $dates)
        {
            $RegisterCountByDate[$i] = ['date' => $dates->date, 'count' => User::where('created_at', 'LIKE', '%'.$dates->date.'%')->count()];
            $i++;
        }

        $date = [];
        $count = [];
        $y=0;

        foreach ($RegisterCountByDate as $array){
            $date[$y] = $array['date'];
            $count[$y] = $array['count'];
            $y++;
        }

        $UserRegistredByDate = (new LarapexChart)->setType('area')
            ->setTitle('Utilisateur enregistrés par mois')
            ->setSubtitle('of the year')
            ->setXAxis($date)
            ->setGrid(true)
            ->setDataset([
                [
                    'name'  =>  'Registred Users',
                    'data'  =>  $count,
                ]
            ]);



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
            // UserRegistred
            'UserRegistredByDate' => $UserRegistredByDate,
        ]);
    }
}
