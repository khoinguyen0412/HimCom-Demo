<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Bank;
use App\Models\BankBranch;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        try{
            DB::beginTransaction();
            $bank_array = include('bankData.php');

            // Check if the file exists
            if ($bank_array) {
                    $add_data = [];
                    foreach ($bank_array as $item) {
                        if (!isset($add_data[$item['Ten ngan hang']])){
                            $add_data[$item['Ten ngan hang']] = [
                                [
                                    'swift_code' => $item['Ten ngan hang'], 
                                    'branch_name'=> $item['Ten chi nhanh']
                                ]
                            ];
                        }
                        else{
                            array_push($add_data[$item['Ten ngan hang']],
                            [
                                'swift_code'=>$item['Ten ngan hang'],
                                'branch_name'=>$item['Ten chi nhanh']
                            ]
                        
                        );
                        }
                    }
                    $bank_id = 1;
                    foreach($add_data as $name=>$value){
                        $bank = Bank::create([
                            'name' => $name,
                        ]);
                        foreach($value as $item){
                            $branch = BankBranch::create([
                                'name' => $item['branch_name'],
                                'swift_code' => $item['swift_code'],
                                'bank_id' => $bank_id,
                            ]);              
                        }
                        $bank_id += 1;
                    }
                    DB::commit();
                } else {
                    throw new \Exception('Error reading Bank Data');
            }
        }catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
