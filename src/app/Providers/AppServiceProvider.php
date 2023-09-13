<?php

namespace App\Providers;

use App\Models\Resume;
use App\Repositories\Api\Banner\BannerRepositoryInterface;
use App\Repositories\Api\Banner\EloquentBannerRepository;
use App\Repositories\Api\FilterBuilder\EloquentFilterBuilderRepository;
use App\Repositories\Api\FilterBuilder\FilterBuilderRepositoryInterface;
use App\Repositories\Api\VideoCall\EloquentVideoCallRepository;
use App\Repositories\Api\VideoCall\VideoCallRepositoryInterface;
use App\Services\Api\Resume\ResumeQueryBuilderService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Api\Vacancies\VacanciesRepositoryInterface;
use App\Repositories\Api\Vacancies\EloquentVacanciesRepository;
use App\Repositories\Api\Account\AccountRepositoryInterface;
use App\Repositories\Api\Account\EloquentAccountRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VacanciesRepositoryInterface::class, EloquentVacanciesRepository::class);
        $this->app->bind(AccountRepositoryInterface::class, EloquentAccountRepository::class);
        $this->app->bind(VideoCallRepositoryInterface::class, EloquentVideoCallRepository::class);
        $this->app->bind(FilterBuilderRepositoryInterface::class, EloquentFilterBuilderRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, EloquentBannerRepository::class);

//        $this->app->bind(ResumeQueryBuilderService::class, function ($app) {
//            return new ResumeQueryBuilderService(Resume::class);
//        });
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->when(EloquentFilterBuilderRepository::class)
            ->needs(Model::class)
            ->give(Resume::class);
    }
}
