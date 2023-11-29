<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Http;
use App\Models\Bank;
use Illuminate\Console\Command;

class SaveBankData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:save-bank-data';

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
        //
        $response = Http::get('https://api.vietqr.io/v2/banks');

        if($response->successful()){
            $responseValue = $response->json();

            if(isset($responseValue['data'])){
                try{
                    $banks = $responseValue['data'];
                    foreach($banks as $bankData){
                        Bank::create([
                            'name' => $bankData['name'],
                            'short_name' => $bankData['shortName'],
                            'logo_url'=>$bankData['logo'],
                            'swift_code'=>$bankData['swift_code'],
                        ]);
                    }
                    $this->info('Bank data saved successfully');
                }
                catch(\Exception $e){
                    $this->info($e->getMessage());
                }
            }
            else{
                $this->error('No "data" key found in the API response.');
            }
        }
        else {
            $this->error('Failed to fetch data from the API.');
        }
    }
}
