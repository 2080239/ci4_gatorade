<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Find existing admin by email
        $builder = $this->db->table('users');
        $admin   = $builder->where('email', 'admin@example.com')->get()->getRowArray();

        $override = getenv('DEFAULT_ADMIN_PASSWORD');

        if ($admin) {
            // If env override provided, reset existing admin password
            if ($override) {
                $passwordHash = password_hash($override, PASSWORD_DEFAULT);
                $this->db->table('users')
                    ->where('id', $admin['id'])
                    ->update([
                        'password_hash' => $passwordHash,
                        'status'        => 'active',
                        'updated_at'    => date('Y-m-d H:i:s'),
                    ]);

                if (ENVIRONMENT !== 'production') {
                    echo "Updated admin@example.com password via DEFAULT_ADMIN_PASSWORD" . PHP_EOL;
                }
            }
            return; // admin already exists
        }

        // Create admin user; use env override or generate a strong random default
        $plain        = $override ?: (bin2hex(random_bytes(6)) . '#A');
        $passwordHash = password_hash($plain, PASSWORD_DEFAULT);
        $builder->insert([
            'role_id'       => 4, // Admin
            'first_name'    => 'System',
            'last_name'     => 'Administrator',
            'email'         => 'admin@example.com',
            'password_hash' => $passwordHash,
            'status'        => 'active',
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);

        // Optionally log generated password in development (do not enable in production)
        if (ENVIRONMENT !== 'production' && !$override) {
            echo "Seeded admin@example.com with temporary password: {$plain}" . PHP_EOL;
        }
    }
}
