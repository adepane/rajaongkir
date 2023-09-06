<?php

namespace App\Console\Commands;

use App\Models\Province;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetProvince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rajaongkir:province';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $req = Http::withHeaders([
            'key' => config('services.rajaongkir.key'),
        ])->get('https://api.rajaongkir.com/starter/province');
        $res = json_decode($req->getBody()->getContents(), true);
        if ($res['rajaongkir']['status']['code'] == 200) {
            if (Province::count() > 0) {
                Province::truncate();
            }
            Province::insert($res['rajaongkir']['results']);
            $this->info($res['rajaongkir']['status']['description']);
        } else {
            $this->info($res['rajaongkir']['status']['description']);
        }
    }
}
