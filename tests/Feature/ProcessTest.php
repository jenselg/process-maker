<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProcessTest extends TestCase
{

      use RefreshDatabase;

      /**
       * Create Processes through API
       */

       public function testCreateProcess () {
         $faker = \Faker\Factory::create();
         $process = [
               'name' => $faker->name,
               'description' => $faker->text,
               'code' => $faker->text,
               'status' => $faker->boolean
             ];
         $response = $this->json('POST', 'api/processes', $process);
         $response->assertStatus(201);
         $response->assertJsonFragment($process);
       }

       /**
        * Read Processes through API
        */

        public function testReadProcess () {
          $response = $this->json('GET', 'api/processes');
          $response->assertStatus(200);
        }

        /**
         * Update Processes through API
         * (Create DB entry first then update it)
         */

         public function testUpdateProcess () {
           $faker = \Faker\Factory::create();
           $process = [
                 'name' => $faker->name,
                 'description' => $faker->text,
                 'code' => $faker->text,
                 'status' => $faker->boolean
               ];
           $response = $this->json('POST', 'api/processes', $process);
           $response->assertStatus(201);
           $response->assertJsonFragment($process);
           $data = json_decode($response->getContent());
           $new_process_data = [
                 'name' => $faker->name,
                 'description' => $faker->text,
                 'code' => $faker->text,
                 'status' => $faker->boolean
               ];
           $new_response = $this->json('PUT', '/api/processes/' . $data->id, $new_process_data);
           $new_response->assertStatus(201);
           $new_data = json_decode($new_response->getContent());
           $this->assertEquals($data->id, $new_data->id);
         }

         /**
          * Delete Processes through API
          * (Create DB entry first then delete it)
          */

          public function testDeleteProcess () {
            $faker = \Faker\Factory::create();
            $process = [
                  'name' => $faker->name,
                  'description' => $faker->text,
                  'code' => $faker->text,
                  'status' => $faker->boolean
                ];
            $response = $this->json('POST', 'api/processes', $process);
            $response->assertStatus(201);
            $data = json_decode($response->getContent());
            $new_response = $this->json('DELETE', '/api/processes/' . $data->id);
            $new_response->assertStatus(200);
            $new_data = json_decode($response->getContent());
            $this->assertEquals($data->id, $new_data->id);
          }

}
