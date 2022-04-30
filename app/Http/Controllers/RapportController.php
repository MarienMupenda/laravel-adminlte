<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Selling;
use App\Models\SellingDetail;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index($from = null, $to = null)
    {
        if ($from == null) $from = Carbon::now()->startOfMonth();
        if ($to == null) $to = Carbon::tomorrow();


        $sellings = SellingDetail::with(['item'])
            ->whereHas('item', function ($q) {
                $q->where('company_id', \Auth::user()->company_id);
            })->whereBetween('created_at', [$from, $to])
            ->get();


        $heads = [
            '#',
            'Designation',
            'Date & Heure',
            'P.U (' . Auth::user()->currency() . ')',
            'Qty',
            'P.T (' . Auth::user()->currency() . ')',
            'Caissier',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $total = 0;

        foreach ($sellings as $selling) {

            $btnEdit = '<a href="' . route('dashboard.sellings.show', $selling->selling->id) . '"
    class="mx-1 shadow btn btn-xs btn-default text-primary" title="Edit">
    <i class="fa fa-lg fa-fw fa-eye"></i>
</a>';

            $rows[] = [
                $selling->selling->id,
                $selling->item->name,
                $selling->date(),
                $selling->price(),
                $selling->qty,
                $selling->total(),
                $selling->user(),
                '<nobr>' . $btnEdit . '</nobr>',
            ];

            $total += $selling->amount();
        }


        $config = [
            'data' => $rows ?? null,
            'order' => [[1, 'asc']],
            'columns' => [['orderable' => true], null, null, null, null, null, null, ['orderable' => false]],
        ];



        $data = [
            'sellings' => $sellings,
            'from' => Carbon::parse($from),
            'to' => Carbon::parse($to),
            'title' => "Rapports",
            'subTitle' => "DU " . mb_strtoupper(\Date::parse($from)->format('d F')) . " AU " .
                mb_strtoupper(\Date::parse($to)->format('d F Y')),
            'config' => $config,
            'heads' => $heads,
            'total' => number_format($total, 2, ',', ' ') . ' ' . Auth::user()->currency()
        ];

        //return $sellings;


        return view('dashboard.rapports.index', $data);
    }
}
