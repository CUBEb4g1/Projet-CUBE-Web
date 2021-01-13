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
            round((100*$TotalUserVerifiedCount)/$TotaluserCount,2),
            round((100*$TotalNotUserVerifiedCount)/$TotaluserCount,2)
        ])
            ->setLabels(['Confirmés', 'Non confirmés'])
            ->setType('pie')
            ->setTitle('Graphique (en %)')
            ->setHeight('200');

        $TotalresourcesCount = Resource::withoutGlobalScope('no_deleted')->count();
        $VerifiedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('validated', 1)->where('deleted', 0)->count();
        $NotVerifiedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('validated', 0)->where('deleted', 0)->count();
        $DeletedresourcesCount = Resource::withoutGlobalScope('no_deleted')->where('deleted', 1)->count();

        $Resourcechart = (new LarapexChart)->setDataset([
                round((100 * $VerifiedresourcesCount)/$TotalresourcesCount,2),
                round((100 * $DeletedresourcesCount)/$TotalresourcesCount,2),
                round((100 * $NotVerifiedresourcesCount)/$TotalresourcesCount,2),
            ])
            ->setLabels(['Validées', 'Supprimées', 'Non Validées'])
            ->setType('pie')
            ->setTitle('Graphique (en %)')
            ->setHeight('200');

        $AllDate = User::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date')
            ->whereRaw("created_at LIKE '%".now()->year."%'")
            ->groupByRaw('date')
            ->get();


        $RegisterCountByDate = [];
        $i = 0;

        foreach ($AllDate->all() as $dates)
        {
            $RegisterCountByDate[$i] = ['date' => $dates->date, 'count' => User::where('created_at', 'LIKE', '%'.$dates->date.'%')->count(), 'percentCount' => round((100*User::where('created_at', 'LIKE', '%'.$dates->date.'%')->count())/$TotaluserCount,2)];
            $i++;
        }

        $date = [];
        $count = [];
        $percentCount = [];
        $y=0;


        foreach ($RegisterCountByDate as $array){
            $date[$y] = $array['date'];
            $count[$y] = $array['count'];
            $percentCount[$y] = $array['percentCount'];
            $y++;
        }

        $UserRegistredByDate = (new LarapexChart)->setType('area')
            ->setTitle('Utilisateur enregistrés par mois')
            ->setSubtitle('of the year')
            ->setXAxis($date)
            ->setGrid(true)
            ->setDataset([
                [
                    'name'  =>  'Utilisateurs enregistré',
                    'data'  =>  $count,
                ],
                [
                    'name' => 'Pourcentage sur le total',
                    'data' => $percentCount,
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

    public function resources()
    {
        $TotalresourcesCount = Resource::withoutGlobalScope('no_deleted')->count();
        $resourceByCategory = Resource::with('relation')->withoutGlobalScope('no_deleted')->get();

        dd($resourceByCategory);
        return view('back.statistics.resources');
    }
}
