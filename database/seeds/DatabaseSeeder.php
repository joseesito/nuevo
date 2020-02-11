<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->truncateTables([
            'courses',
            'permissions',
            'roles',
            'type_courses',
            'unities',
            'users',
            'companies',
            'unities',

        ]);
        $this->call(UnityTableSeeder::class);
        $this->call(TypeCoursesTableSeeder::class);
        $this->call(CourseTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(CompanyTableSeeder::class);


        $this->call(UserTableSeeder::class);



    }
        protected function truncateTables(array $tables)

        {
            DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
            foreach($tables as $table)

            {
                DB::table($table)->truncate();
            }

            DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        }
}
