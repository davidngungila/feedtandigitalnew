<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'View Users', 'slug' => 'view-users', 'group_name' => 'Users', 'description' => 'View all users'],
            ['name' => 'Create Users', 'slug' => 'create-users', 'group_name' => 'Users', 'description' => 'Create new users'],
            ['name' => 'Edit Users', 'slug' => 'edit-users', 'group_name' => 'Users', 'description' => 'Edit existing users'],
            ['name' => 'Delete Users', 'slug' => 'delete-users', 'group_name' => 'Users', 'description' => 'Delete users'],
            
            ['name' => 'View Roles', 'slug' => 'view-roles', 'group_name' => 'Roles', 'description' => 'View all roles'],
            ['name' => 'Create Roles', 'slug' => 'create-roles', 'group_name' => 'Roles', 'description' => 'Create new roles'],
            ['name' => 'Edit Roles', 'slug' => 'edit-roles', 'group_name' => 'Roles', 'description' => 'Edit existing roles'],
            ['name' => 'Delete Roles', 'slug' => 'delete-roles', 'group_name' => 'Roles', 'description' => 'Delete roles'],
            
            ['name' => 'View Permissions', 'slug' => 'view-permissions', 'group_name' => 'Permissions', 'description' => 'View all permissions'],
            
            ['name' => 'View Members', 'slug' => 'view-members', 'group_name' => 'Members', 'description' => 'View all members'],
            ['name' => 'Create Members', 'slug' => 'create-members', 'group_name' => 'Members', 'description' => 'Create new members'],
            ['name' => 'Edit Members', 'slug' => 'edit-members', 'group_name' => 'Members', 'description' => 'Edit existing members'],
            ['name' => 'Delete Members', 'slug' => 'delete-members', 'group_name' => 'Members', 'description' => 'Delete members'],
            
            ['name' => 'View Savings', 'slug' => 'view-savings', 'group_name' => 'Savings', 'description' => 'View all savings accounts'],
            ['name' => 'Manage Savings', 'slug' => 'manage-savings', 'group_name' => 'Savings', 'description' => 'Create, edit, and manage savings accounts'],
            
            ['name' => 'View Loans', 'slug' => 'view-loans', 'group_name' => 'Loans', 'description' => 'View all loans'],
            ['name' => 'Manage Loans', 'slug' => 'manage-loans', 'group_name' => 'Loans', 'description' => 'Create, edit, and manage loans'],
            
            ['name' => 'View Transactions', 'slug' => 'view-transactions', 'group_name' => 'Transactions', 'description' => 'View all transactions'],
            ['name' => 'Manage Transactions', 'slug' => 'manage-transactions', 'group_name' => 'Transactions', 'description' => 'Create, edit, and manage transactions'],
            
            ['name' => 'View Reports', 'slug' => 'view-reports', 'group_name' => 'Reports', 'description' => 'View reports and analytics'],
            ['name' => 'Manage Reports', 'slug' => 'manage-reports', 'group_name' => 'Reports', 'description' => 'Create and manage reports'],
            
            ['name' => 'View Settings', 'slug' => 'view-settings', 'group_name' => 'Settings', 'description' => 'View system settings'],
            ['name' => 'Manage Settings', 'slug' => 'manage-settings', 'group_name' => 'Settings', 'description' => 'Edit system settings'],
            
            ['name' => 'View Audit Logs', 'slug' => 'view-audit-logs', 'group_name' => 'Audit', 'description' => 'View audit logs'],
            ['name' => 'Manage KYC', 'slug' => 'manage-kyc', 'group_name' => 'Audit', 'description' => 'Manage KYC verifications'],
        ];
        
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(
                ['slug' => $perm['slug']],
                [
                    'name' => $perm['name'],
                    'description' => $perm['description'],
                    'group_name' => $perm['group_name']
                ]
            );
        }

        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'super-admin',
                'description' => 'Full access to everything',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Administrative access',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Manager',
                'slug' => 'manager',
                'description' => 'Branch manager',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Teller',
                'slug' => 'teller',
                'description' => 'Bank teller',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Auditor',
                'slug' => 'auditor',
                'description' => 'Audit officer',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Loan Officer',
                'slug' => 'loan-officer',
                'description' => 'Manages loans',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Accountant',
                'slug' => 'accountant',
                'description' => 'Financial accountant',
                'is_active' => true,
                'is_system' => true
            ],
            [
                'name' => 'Member',
                'slug' => 'member',
                'description' => 'Regular member',
                'is_active' => true,
                'is_system' => true
            ],
        ];

        foreach ($roles as $roleData) {
            $role = Role::firstOrCreate(
                ['slug' => $roleData['slug']],
                [
                    'name' => $roleData['name'],
                    'description' => $roleData['description'],
                    'is_active' => $roleData['is_active'],
                    'is_system' => $roleData['is_system']
                ]
            );

            if ($role->slug === 'super-admin') {
                $role->syncPermissions(Permission::pluck('id')->toArray());
            } elseif ($role->slug === 'admin') {
                $adminPerms = Permission::whereIn('slug', [
                    'view-users', 'create-users', 'edit-users', 'delete-users',
                    'view-roles', 'view-permissions',
                    'view-members', 'create-members', 'edit-members', 'delete-members',
                    'view-savings', 'manage-savings',
                    'view-loans', 'manage-loans',
                    'view-transactions', 'manage-transactions',
                    'view-reports', 'manage-reports',
                    'view-settings', 'manage-settings',
                    'view-audit-logs', 'manage-kyc'
                ])->pluck('id')->toArray();
                $role->syncPermissions($adminPerms);
            } elseif ($role->slug === 'manager') {
                $managerPerms = Permission::whereIn('slug', [
                    'view-users', 'view-members',
                    'view-savings', 'manage-savings',
                    'view-loans', 'manage-loans',
                    'view-transactions',
                    'view-reports'
                ])->pluck('id')->toArray();
                $role->syncPermissions($managerPerms);
            } elseif ($role->slug === 'teller') {
                $tellerPerms = Permission::whereIn('slug', [
                    'view-members',
                    'view-savings',
                    'view-transactions', 'manage-transactions'
                ])->pluck('id')->toArray();
                $role->syncPermissions($tellerPerms);
            } elseif ($role->slug === 'auditor') {
                $auditorPerms = Permission::whereIn('slug', [
                    'view-users',
                    'view-members',
                    'view-savings',
                    'view-loans',
                    'view-transactions',
                    'view-reports',
                    'view-audit-logs',
                    'manage-kyc'
                ])->pluck('id')->toArray();
                $role->syncPermissions($auditorPerms);
            } elseif ($role->slug === 'member') {
                $memberPerms = Permission::whereIn('slug', [
                    'view-members'
                ])->pluck('id')->toArray();
                $role->syncPermissions($memberPerms);
            }
        }
    }
}
