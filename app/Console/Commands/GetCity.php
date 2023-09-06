<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rajaongkir:city';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get City List from Raja Ongkir';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $req = Http::withHeaders([
            'key' => config('services.rajaongkir.key'),
        ])->get('https://api.rajaongkir.com/starter/city');
        $res = json_decode($req->getBody()->getContents(), true);
        if ($res['rajaongkir']['status']['code'] == 200) {
            if (City::count() > 1) {
                City::truncate();
            }
            City::insert($res['rajaongkir']['results']);
            $this->info($res['rajaongkir']['status']['description']);
        } else {
            $this->info($res['rajaongkir']['status']['description']);
        }
    }
}
