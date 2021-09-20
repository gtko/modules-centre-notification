<?php

namespace Modules\CentreNotification\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\BaseCore\Contracts\Services\CompositeurThemeContract;
use Modules\BaseCore\Contracts\Services\ThemeContract;
use Modules\BaseCore\Contracts\Views\MobileMenuBarContract;
use Modules\BaseCore\Contracts\Views\TopBarContract;
use Modules\BaseCore\Entities\TypeView;

class CentreNotificationServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'CentreNotification';

    /**
     * @var string $moduleNameLower
     */
    protected string $moduleNameLower = 'centrenotification';




    /**
     * Register services.
     */
    public function register()
    {

        $notificationIconView = new TypeView(TypeView::TYPE_LIVEWIRE,'centrenotification::notification-header');

        app(CompositeurThemeContract::class)
            ->setViews(TopBarContract::class, [
                $notificationIconView
            ])
            ->setViews(MobileMenuBarContract::class, [
                $notificationIconView
            ]);

    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

    }


    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(),[app(ThemeContract::class)->getPath()],[$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
