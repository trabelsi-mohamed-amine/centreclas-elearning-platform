<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdminMessage;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ensure there's at least one admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('password'),
                'role_id' => 1, // Assuming 1 is admin role
            ]
        );

        // Course-related messages
        $messages = [
            // General course information
            "Our courses are designed to provide hands-on learning experiences in various fields. Each course includes practical exercises, real-world projects, and expert guidance.",

            // Course catalog overview
            "We offer courses in: \n1. Web Development (Frontend & Backend)\n2. Data Science and Analytics\n3. Digital Marketing\n4. Project Management\n5. Business Administration",

            // Course structure
            "Each course follows a structured learning path:\n1. Foundational concepts\n2. Practical exercises\n3. Real-world projects\n4. Final assessment\nThis ensures you gain both theoretical knowledge and practical skills.",

            // Enrollment process
            "To enroll in a course:\n1. Browse our course catalog\n2. Select your desired course\n3. Click the 'Enroll' button\n4. Complete the registration form\n5. Process payment\nOur support team is available to help if needed.",

            // Schedule information
            "Our courses offer flexible scheduling options:\n1. Self-paced learning\n2. Evening classes\n3. Weekend sessions\n4. Intensive boot camps\nYou can choose the format that best fits your schedule.",

            // Price information
            "Course pricing varies by program:\n1. Short courses: $299-$599\n2. Professional certificates: $799-$1499\n3. Specialized programs: $1999+\nWe offer payment plans and early bird discounts.",

            // Prerequisites
            "Most courses are beginner-friendly, but some advanced courses may require:\n1. Basic computer literacy\n2. Fundamental knowledge in the field\n3. Completion of prerequisite courses\nCheck individual course descriptions for specific requirements.",

            // Course benefits
            "By taking our courses, you'll gain:\n1. Industry-relevant skills\n2. Hands-on project experience\n3. Professional certification\n4. Career support\n5. Networking opportunities",
        ];

        foreach ($messages as $message) {
            AdminMessage::create([
                'message' => $message,
                'admin_id' => $admin->id,
            ]);
        }

        DB::table('enrollment')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'session_id' => 1,
                'enrolled_at' => now(),
                'status' => 'pending',
            ],
            [
                'id' => 2,
                'user_id' => 2,
                'session_id' => 1,
                'enrolled_at' => now(),
                'status' => 'accepted',
            ],
            [
                'id' => 3,
                'user_id' => 3,
                'session_id' => 2,
                'enrolled_at' => now(),
                'status' => 'not paid',
            ],
        ]);
    }
}
