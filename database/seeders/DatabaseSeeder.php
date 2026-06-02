<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\SavingsAccount;
use App\Models\Loan;
use App\Models\Investment;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tanzNames = [
            'Hamisi Juma Makwetta', 'Fatuma Rashid Ally', 'Joseph Mwangi Oduya', 'Amina Salim Hassan', 'David Kimani Njoroge',
            'Juma Bakari', 'Grace Nyambo', 'Emmanuel Kiiza', 'Zuhura Rashid', 'Patrick Mwangi',
            'Baraka Cosmas', 'Neema Okonkwo', 'Yusuf Kombo', 'Rehema Said', 'Daniel Mganga',
            'Salma Mwinyi', 'Henry Ndagala', 'Zawadi Maganga', 'Francis Msigwa', 'Khadija Omar'
        ];

        $regions = ['Dar es Salaam', 'Mwanza', 'Arusha', 'Mbeya', 'Dodoma', 'Morogoro', 'Tanga', 'Kilimanjaro'];

        // Create Admin
        $admin = User::create([
            'name' => 'Hamisi Juma Makwetta',
            'email' => 'admin@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 713 000 001',
        ]);

        // Create Manager
        User::create([
            'name' => 'Fatuma Rashid Ally',
            'email' => 'manager@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'branch' => 'Mwanza Branch',
            'phone' => '+255 754 000 002',
        ]);

        // Create Teller
        User::create([
            'name' => 'Joseph Mwangi Oduya',
            'email' => 'teller@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'teller',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 622 000 003',
        ]);

        // Create Auditor
        User::create([
            'name' => 'Amina Salim Hassan',
            'email' => 'auditor@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'auditor',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 784 000 004',
        ]);

        // Create Deposit Officer
        User::create([
            'name' => 'Grace Nyambo',
            'email' => 'deposit@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'deposit_officer',
            'branch' => 'Mwanza Branch',
            'phone' => '+255 754 000 005',
        ]);

        // Create Loan Officer
        User::create([
            'name' => 'Emmanuel Kiiza',
            'email' => 'loanofficer@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'loan_officer',
            'branch' => 'Arusha Branch',
            'phone' => '+255 713 000 006',
        ]);

        // Create SWF Officer
        User::create([
            'name' => 'Zuhura Rashid',
            'email' => 'swfofficer@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'swf_officer',
            'branch' => 'Mbeya Branch',
            'phone' => '+255 655 000 007',
        ]);

        // Create Marketing Officer
        User::create([
            'name' => 'Patrick Mwangi',
            'email' => 'marketing@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'marketing_officer',
            'branch' => 'Dodoma Branch',
            'phone' => '+255 785 000 008',
        ]);

        // Create Secretary
        User::create([
            'name' => 'Baraka Cosmas',
            'email' => 'secretary@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'secretary',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 714 000 009',
        ]);

        // Create Chairperson
        User::create([
            'name' => 'Neema Okonkwo',
            'email' => 'chairperson@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'chairperson',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 756 000 010',
        ]);

        // Create Accountant
        User::create([
            'name' => 'Yusuf Kombo',
            'email' => 'accountant@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'accountant',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 623 000 011',
        ]);

        // Create Member User & Profile
        $memberUser = User::create([
            'name' => 'Rehema Said',
            'email' => 'member@feedtan.co.tz',
            'password' => Hash::make('password'),
            'role' => 'member',
            'branch' => 'Dar es Salaam HQ',
            'phone' => '+255 784 000 012',
        ]);

        $memberProfile = Member::create([
            'user_id' => $memberUser->id,
            'member_no' => 'FDT/2019/00421',
            'nida' => '19900101123456789012',
            'phone' => '+255 784 000 004',
            'occupation' => 'Teacher',
            'employer' => 'Ministry of Education',
            'region' => 'Dar es Salaam',
            'joined_at' => Carbon::now()->subYears(5),
            'status' => 'Active',
        ]);

        // Add Savings for Member
        $savingsProducts = [
            ['RDA', 2840000, 5000000],
            ['FLEX', 1200000, 3000000],
            ['Emergency', 800000, 2000000]
        ];

        foreach ($savingsProducts as $p) {
            SavingsAccount::create([
                'member_id' => $memberProfile->id,
                'account_no' => 'FDT/SAV/' . rand(10000, 99999),
                'product_type' => $p[0],
                'balance' => $p[1],
                'target_amount' => $p[2],
            ]);
        }

        // Add Loan for Member
        Loan::create([
            'member_id' => $memberProfile->id,
            'loan_no' => 'LN/2024/00156',
            'loan_type' => 'Development Loan',
            'principal' => 6500000,
            'interest_rate' => 18,
            'term_months' => 24,
            'balance' => 4823000,
            'installment_amount' => 327000,
            'status' => 'active',
            'purpose' => 'Housing renovation',
            'disbursed_at' => Carbon::now()->subMonths(6),
            'next_due_date' => Carbon::now()->addDays(15),
        ]);

        // Add Transactions for Member
        Transaction::create([
            'member_id' => $memberProfile->id,
            'type' => 'deposit',
            'amount' => 500000,
            'balance_after' => 2840000,
            'channel' => 'M-Pesa',
            'reference' => 'DEP/00891234',
            'narration' => 'Monthly savings RDA',
            'created_at' => Carbon::now()->subDays(2),
        ]);

        // Create 50 more random members
        for ($i = 0; $i < 50; $i++) {
            $name = $tanzNames[array_rand($tanzNames)] . ' ' . Str::random(3);
            $email = strtolower(str_replace(' ', '.', $name)) . '@example.com';
            
            $u = User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('password'),
                'role' => 'member',
                'branch' => $regions[array_rand($regions)] . ' Branch',
                'phone' => '+255 7' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999),
            ]);

            $m = Member::create([
                'user_id' => $u->id,
                'member_no' => 'FDT/2024/' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                'nida' => '19' . rand(100000000, 999999999) . 'TZ',
                'phone' => $u->phone,
                'region' => $regions[array_rand($regions)],
                'joined_at' => Carbon::now()->subMonths(rand(1, 60)),
                'status' => 'Active',
            ]);

            // Random savings
            SavingsAccount::create([
                'member_id' => $m->id,
                'account_no' => 'FDT/SAV/' . rand(10000, 99999),
                'product_type' => 'RDA',
                'balance' => rand(100000, 10000000),
            ]);

            // Random loan (some members)
            if (rand(0, 1)) {
                Loan::create([
                    'member_id' => $m->id,
                    'loan_no' => 'LN/2024/' . str_pad($i + 1, 5, '0', STR_PAD_LEFT),
                    'loan_type' => 'Emergency',
                    'principal' => rand(500000, 5000000),
                    'interest_rate' => 12,
                    'term_months' => 6,
                    'balance' => rand(100000, 4000000),
                    'installment_amount' => rand(50000, 500000),
                    'status' => 'active',
                ]);
            }
        }
    }
}
