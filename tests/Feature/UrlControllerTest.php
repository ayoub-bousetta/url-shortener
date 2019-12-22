<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use App\Link;
use App\User;
use Faker\Generator as Faker;
class UrlControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex_return_home()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/url');
       
        $response->assertStatus(200);
    }


    public function testIndex_return_post()
    {
        //$this->withoutExceptionHandling();
        $user=factory(User::class)->make();

        $this->actingAs($user)->get('/url');
        $link=factory(Link::class)->create();
     
       $result= Link::all();
    

       $this->assertEquals(1, count($result));
     
    }

    
    public function testIndex_return_sortit()
    {
        //$this->withoutExceptionHandling();
        
        $user=factory(User::class)->make();

        $this->actingAs($user)->get('/url');
        $link=factory(Link::class)->create(['name'=>'Yes']);//Create data
       $result= Link::find($link->id)->first();//check if created
       $this->assertEquals(1, $result->count());
     
    }

    
    function testvalidat_the_requested_data(){
       // $this->withoutExceptionHandling();
       $user=factory(User::class)->make();
       $link=factory(Link::class)->make(['or_link' => null]);
    
         
         $response =  $this->actingAs($user)->post('/url', $link->toArray());
         $response->assertJsonCount(1, $key = 'error');
         $response->assertStatus(200);
        
      


    }

    function testvalidat_the_requested_mustbeUrl(){
        // $this->withoutExceptionHandling();
        
          $link=factory(Link::class)->make(['or_link' => 'text']);
          $response = $this->post('/url', $link->toArray());
          $response->assertJsonCount(1, $key = 'error');
         $response->assertStatus(200);
         
    
 
     }
     function testvalidat_the_requested_name_must_be_pointed(){
        // $this->withoutExceptionHandling();
        
          $link=factory(Link::class)->make(['name' => '']);
          $response = $this->post('/url', $link->toArray());
          $response->assertJsonCount(1, $key = 'error');
         $response->assertStatus(200);
       
     }

     function testvalidat_the_requested_name_must_be_5char(){
         //$this->withoutExceptionHandling();
        
          $link=factory(Link::class)->make(['name' => 'tet']);
          $response = $this->post('/url', $link->toArray());
          $response->assertJsonCount(1, $key = 'error');
          $response->assertStatus(200);
       
     }


     function testvalidat_the_requested_to_get_all_urls(){
       // $this->withoutExceptionHandling();
        
        $user=factory(User::class)->create();
        $link=factory(Link::class)->create(['user_id' =>$user->id]);
    
         $response = $this->actingAs($user)->get('/getallurl');
       
         

         $urls=Link::all()->where('user_id',$user->id);


         $this->assertEquals(1, $urls->count());
         $response->assertStatus(200);
      
    }

    function testvalidat_the_requested_to_edit_your_url(){
    
        $user=factory(User::class)->create();
        $link=factory(Link::class)->create(['user_id' =>$user->id]);

        $response = $this->actingAs($user)->get('/url/edit/'.$link->id);

        $urls=Link::all()->where('user_id',$user->id);
        $this->assertEquals(1, $urls->count());
        $response->assertStatus(200);

    }


    function testvalidat_the_requested_to_save_the_edited_url(){
    
        $user=factory(User::class)->create();
        $link=factory(Link::class)->create(['user_id' =>$user->id]);

        $response = $this->actingAs($user)->post('/url/edit/'.$link->id,['name'=>"testing",'or_link'=>'http://127.0.0.1:8000/url']);
    
        $urls=Link::all()->where('user_id',$user->id);
        $this->assertEquals(1, $urls->count());
        $response->assertStatus(200);

    }


    function testvalidat_the_requested_to_delete_url(){
    
        $user=factory(User::class)->create();
        $link=factory(Link::class)->create(['user_id' =>$user->id]);

        $response = $this->actingAs($user)->delete('url/delete/'.$link->id);
    
        $urls=Link::all()->where('user_id',$user->id);
        $this->assertEquals(0, $urls->count());
        $response->assertStatus(200);

    }

    function testvalidat_the_requested_to_geturl_bycode(){
    

        $response = $this->get('/DWuNxw');
        $urls=Link::all()->where('gen_code','DWuNxw');
        $this->assertEquals(1, $urls->count());
        //$response->assertStatus(301);

    }
     



}
