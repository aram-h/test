<?php

use Illuminate\Database\Seeder;
use \App\Status;
class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::query()->delete();

        foreach (Status::$statuses as $k => $status) {
            $model = new Status();
            $model->id = $k + 1;
            $model->name = $status;
            $model->save();
        }
    }
}
