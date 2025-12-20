<?php

namespace Database\Factories;

use App\Models\OrgVerification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrgVerificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrgVerification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'organization_name' => $this->faker->company,
            'organization_description' => $this->faker->paragraph,
            'document_path' => 'org_verification_documents/' . $this->faker->uuid . '.pdf',
            'document_type' => 'pdf',
            'status' => 'pending',
            'submitted_at' => now(),
        ];
    }
}
