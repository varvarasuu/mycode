<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BlackListDetail;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use App\Models\CategoryName;
use App\Models\DefaultPremission;
use App\Models\EmployeePremission;
use App\Models\PaidCatalog;
use App\Models\RoleInCompany;
use App\Models\ResumeLanguageLevel;
use App\Models\VacancyApplicationCriteria;
use App\Models\VehicleType;
use App\Models\WorkHourType;
use App\Models\WorkSpace;
use Illuminate\Database\DeadlockException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProfessionalLevelSeeder::class);

        
        $this->call(CompanySizeSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(RegionsSeeder::class);
        $this->call(GendersSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(AccountsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(RoleInCompanySeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(DetailListOfEmployeesSeeder::class);
        
        $this->call(DocumentPortfolioTypeSeeder::class);

      

        

        $this->call(MetroSeeder::class);

        $this->call([
            SectionForCategoriesSeeder::class,
            CategoryNamesSeeder::class,
            CategorySeeder::class,
        ]);

        
        $this->call(CoverLetterSeeder::class);
        


        $this->call(PortfolioSeeder::class);
        $this->call(CasePortfolioSeeder::class);
        $this->call(DocumentPortfolioSeeder::class);

        

        

        $this->call(OfficeSeeder::class);
        $this->call(OfficeMetroSeeder::class);

        
        $this->call(DefaultTemplateSeeder::class);
        $this->call(TemplateSeeder::class);



    }
}
