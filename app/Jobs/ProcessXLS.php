<?php

namespace Jobs;

use App\Produtos;
use App\Planilhas;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessXLS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $planilha = Planilhas::where('status',0)
                    ->orderBy('id', 'asc')
                    ->get();

        Excel::load(storage_path('app\public\planilhas\\').$planilha[0]->name, function($reader) {

            //$reader->noHeading()->ignoreEmpty()->dump();
            $sheet = $reader->noHeading()->ignoreEmpty()->get();

            foreach ($sheet[0]->toArray() as $key => $row) {

                if ($key == 0) {
                    $category = $row[1];
                }

                if ($key > 2) {

                    $produto = new Produtos();

                    $produto->Im = $row[0];
                    $produto->name = $row[1];
                    $produto->free_shipping = $row[2];
                    $produto->description = $row[3];
                    $produto->price = $row[4];
                    $produto->Category = $category;

                    $produto->save();
                }

            }
        });

        $planilha[0]->status = 1;
        $planilha[0]->save();

    }
}
