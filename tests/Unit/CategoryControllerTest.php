<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_display_a_list_of_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->get(route('categories.index'));

        $response->assertStatus(200);
        $response->assertViewHas('categories');
    }

    /** @test */
    public function it_can_show_the_create_category_form()
    {
        $response = $this->get(route('categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('category.create');
    }

    /** @test */
    public function it_can_store_a_new_category()
    {
        $response = $this->post(route('categories.store'), [
            'name' => 'New Category',
        ]);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category created successfully.');
        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    /** @test */
    public function test_it_can_show_the_create_category_form()
    {
        $response = $this->get(route('categories.create'));

        // Debugging line
        dd($response->getContent());

        $response->assertStatus(200);
        $response->assertViewIs('category.create');
    }

    /** @test */
    public function it_can_update_an_existing_category()
    {
        $category = Category::factory()->create();

        $response = $this->put(route('categories.update', $category), [
            'name' => 'Updated Category',
        ]);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category updated successfully.');
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Updated Category']);
    }

    /** @test */
    public function it_can_delete_a_category()
    {
        $category = Category::factory()->create();

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('success', 'Category deleted successfully.');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
