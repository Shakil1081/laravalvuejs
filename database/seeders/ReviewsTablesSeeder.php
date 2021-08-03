<?php
namespace Database\Seeders;

use App\Models\Bookable;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bookable::all()->each( function(Bookable $bookable){
            
            $review = Review::factory(random_int(1,5))->make();

            $bookable->reviews()->saveMany($review);
        });
    }
}
