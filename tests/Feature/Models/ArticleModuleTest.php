<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Article;
use App\Providers\RouteServiceProvider;

class ArticleModuleTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_list_artiles_whit_user_autenticated()
    {
        $user = User::find(2);
 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $response = $this->get('/dashboard/articles');
        $response->assertStatus(200);

    }
    
    public function test_get_list_artiles_whit_not_user_autenticated()
    {        
        $response = $this->get('/dashboard/articles');
        $response->assertRedirect("/login");
    }

    public function test_created_article()
    {   
        $user = User::find(2);
 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response = $this->get('/dashboard/articles');
        $response->assertStatus(200);

        $response = $this->post('/article/save', [
            'name' => 'pollo',
                'photo' => null,
                'comment' => 'pollo',
                'measure_unit_id' => 1,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
        ]);
        $response->assertRedirect('/dashboard/articles');
    }

    public function test_updated_article()
    {
        $user = User::find(2);
 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response = $this->get('/dashboard/articles');
        $response->assertStatus(200);
        $article = Article::find(1);

        $response = $this->post('/article/change', [
            'name' => 'pollo',
            'photo' => null,
            'comment' => 'pollo',
            'measure_unit_id' => 1,
            'active' => true,
            'created_at' => now(),
            'updated_at' => now(),
            'article_id' => $article->id,
        ]);
        $response->assertRedirect('/dashboard/articles');
    }

    public function test_delete_article()
    {
        $user = User::find(2);
 
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $response = $this->get('/dashboard/articles');
        $response->assertStatus(200);

        $response = $this->get('/article/delete/5', );
        $response->assertRedirect('/dashboard/articles');
    }
}
