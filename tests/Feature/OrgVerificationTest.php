<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\OrgVerification;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OrgVerificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_unauthenticated_user_cannot_submit_a_verification_request()
    {
        $this->post(route('org_verification.store'), [])
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function an_authenticated_user_without_org_rep_role_cannot_submit_a_verification_request()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->post(route('org_verification.store'), [])
            ->assertRedirect(route('dashboard'));
    }

    /** @test */
    public function an_authenticated_user_with_org_rep_role_can_submit_a_verification_request()
    {
        Storage::fake('local');

        $user = User::factory()->create();
        $user->addRole('org_rep');

        $data = [
            'organization_name' => 'Test Org',
            'organization_description' => 'Test Description',
            'document' => UploadedFile::fake()->create('document.pdf', 100),
        ];

        $this->actingAs($user)
            ->post(route('org_verification.store'), $data)
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('org_verification_documents', [
            'user_id' => $user->id,
            'organization_name' => 'Test Org',
        ]);

        Storage::disk('local')->assertExists(OrgVerification::first()->document_path);
    }

    /** @test */
    public function an_admin_can_see_the_list_of_verification_requests()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $this->actingAs($admin)
            ->get(route('admin.org_verifications.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function a_non_admin_user_cannot_see_the_list_of_verification_requests()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get(route('admin.org_verifications.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function an_admin_can_approve_a_verification_request()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $verification = OrgVerification::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.org_verifications.approve', $verification))
            ->assertRedirect();

        $this->assertDatabaseHas('org_verification_documents', [
            'id' => $verification->id,
            'status' => 'approved',
        ]);
    }

    /** @test */
    public function an_admin_can_reject_a_verification_request()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $verification = OrgVerification::factory()->create();

        $this->actingAs($admin)
            ->post(route('admin.org_verifications.reject', $verification), ['admin_notes' => 'Test notes'])
            ->assertRedirect();

        $this->assertDatabaseHas('org_verification_documents', [
            'id' => $verification->id,
            'status' => 'rejected',
            'admin_notes' => 'Test notes',
        ]);
    }

    /** @test */
    public function a_user_can_view_their_own_verification_document()
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $verification = OrgVerification::factory()->create(['user_id' => $user->id]);
        Storage::disk('local')->put($verification->document_path, 'test content');

        $this->actingAs($user)
            ->get(route('admin.org_verifications.show_document', $verification))
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_cannot_view_another_users_verification_document()
    {
        Storage::fake('local');
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $verification = OrgVerification::factory()->create(['user_id' => $user1->id]);
        Storage::disk('local')->put($verification->document_path, 'test content');

        $this->actingAs($user2)
            ->get(route('admin.org_verifications.show_document', $verification))
            ->assertStatus(403);
    }
}
