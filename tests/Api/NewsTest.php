<?php
namespace Tests\Api;

use Tests\TestCase;

/**
 * @author Sergei Melnikov <me@rnr.name>
 */
class NewsTest extends TestCase
{
     public function testIndexNews() {
         $response = $this->get('/api/news');

         $this->assertResponseOk();

         $data = json_decode($response);

//         $this->
     }
}