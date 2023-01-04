<?php

namespace Tests\Feature;

use App\Constants\RoleConstants;
use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Tests\UserHelperTrait;

class CustomerDocumentTest extends TestCase
{
    use RefreshDatabase, UserHelperTrait;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('passport:install');
        $this->artisan('load:permissions');
        $this->artisan('db:seed');
    }

    public function test_user_can_see_customer_index_page()
    {
        $user = $this->actingAsUserWithRegistrarRole();
        Passport::actingAs($user);

        $response = $this->get(route('api.v1.documents.index'));

        $response
            ->assertSuccessful()
            ->assertJsonStructure([
                "success",
                "data" => [
                    [
                        "id",
                        "name",
                    ],
                ],
            ]);
    }

    public function test_registrar_role_has_access_to_customer_document_index()
    {
        $user = $this->actingAsUserWithRegistrarRole();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.documents.index'));

        $response->assertSuccessful();
    }

    public function test_reviewer_role_has_not_access_to_customer_document_index()
    {
        $user = $this->actingAsUserWithReviewerRole();

        Passport::actingAs($user);

        $response = $this->get(route('api.v1.documents.index'));

        $response->assertStatus(403);
    }

    private function actingAsUserWithRegistrarRole()
    {
        $user = $this->getUser();
        $role = Role::query()
            ->where('name', '=', RoleConstants::REGISTRAR)
            ->first();
        $user->attachRole($role);

        return $user->refresh();
    }

    private function actingAsUserWithReviewerRole()
    {
        $user = $this->getUser();
        $role = Role::query()
            ->where('name', '=', RoleConstants::REVIEWER)
            ->first();
        $user->attachRole($role);

        return $user->refresh();
    }
}
