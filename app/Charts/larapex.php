<?php

namespace App\Charts;

use App\Models\Loan;
use App\Models\User;
use App\Models\Instalment;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class Larapex
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(User $user)
    {
        // dd($data);
$i=0;
        $userLoans = Loan::whereBelongsTo($user)->get();
        foreach ($userLoans as $lon)
            $i++;
        if($i==0 )  return $this->chart->pieChart()
        ->setTitle('Loan Status')
        ->addData([
            0, 0
        ])
        ->setColors(['#40E0D0', '#DE3163'])
        ->setLabels(['Paid', 'Remind']);
        // dd($userLoans);
        if ($userLoans != null) {
            $total =   Instalment::whereBelongsTo($userLoans)->sum('amount');

            $Paid = Instalment::whereBelongsTo($userLoans)->Paid()->sum('amount');
            $remind = $total - $Paid;
        }


        return $this->chart->pieChart()
            ->setTitle('Loan Status')
            ->addData([
                $Paid, $remind
            ])
            ->setColors(['#40E0D0', '#DE3163'])
            ->setLabels(['Paid', 'Remind']);
    }
}
