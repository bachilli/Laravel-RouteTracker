<?php

namespace App\Providers;

use App\Composers\CPanel\Position\BannerPositionComposer;
use App\Composers\CPanel\Position\PageFieldPositionComposer;
use App\Composers\CPanel\Position\PagePositionComposer;
use App\Composers\CPanel\Position\ServiceFieldPositionComposer;
use App\Composers\CPanel\Position\ServicePositionComposer;
use App\Composers\CPanel\Position\UsedVehiclePhotoPositionComposer;
use App\Composers\CPanel\Position\UsedVehiclePositionComposer;
use App\Composers\CPanel\Position\VehicleAccessoryPositionComposer;
use App\Composers\CPanel\Position\VehicleAccessoryTypePositionComposer;
use App\Composers\CPanel\Position\VehicleColorPositionComposer;
use App\Composers\CPanel\Position\VehicleEquipmentFieldPositionComposer;
use App\Composers\CPanel\Position\VehicleEquipmentPositionComposer;
use App\Composers\CPanel\Position\VehicleMaintenancePricePositionComposer;
use App\Composers\CPanel\Position\VehiclePhotoPositionComposer;
use App\Composers\CPanel\Position\VehiclePositionComposer;
use App\Composers\CPanel\Position\VehicleSpecFieldPositionComposer;
use App\Composers\CPanel\Position\VehicleSpecPositionComposer;
use App\Composers\CPanel\Position\VehicleTypePositionComposer;
use App\Composers\CPanel\ServiceTypeComposer;
use App\Composers\CPanel\UsedVehicleFuelComposer;
use App\Composers\CPanel\UsedVehicleGearboxComposer;
use App\Composers\CPanel\VehicleAccessoryTypeComposer;
use App\Composers\CPanel\VehicleColorTypeComposer;
use App\Composers\CPanel\VehicleComposer;
use App\Composers\CPanel\VehicleTypeComposer;
use App\Composers\CPanel\YesOrNoComposer;
use App\Composers\Primary\ExclusiveServiceComposer;
use App\Composers\Primary\FabricationYearComposer;
use App\Composers\Primary\FipeVehicleBrandComposer;
use App\Composers\Primary\MileageComposer;
use App\Composers\Primary\ModelYearComposer;
use App\Composers\Primary\PageComposer;
use App\Composers\Primary\ServiceVehicleComposer;
use App\Composers\Primary\StateComposer;
use App\Composers\Primary\VehicleTypeMenuComposer;
use App\Models\Page;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->view->share('pageTitle', '');
        $this->app->view->share('metaDescription', '');
        $this->app->view->composer('*', VehicleTypeMenuComposer::class);
        $this->app->view->composer('primary.*', PageComposer::class);

        //
        // Primary
        //

        // Exclusive Service
        $this->app->view->composer([
            'primary.exclusive-services.index',
        ], ExclusiveServiceComposer::class);

        // Brand (Fipe Vehicle)
        $this->app->view->composer([
            'primary.homepage',
            'primary.vehicles.single',
        ], FipeVehicleBrandComposer::class);

        // Mileage
        $this->app->view->composer([
            'primary.homepage',
            'primary.vehicles.single',
        ], MileageComposer::class);

        // Fabrication Year
        $this->app->view->composer([
            'primary.homepage',
            'primary.vehicles.single',
        ], FabricationYearComposer::class);

        // Model Year
        $this->app->view->composer([
            'primary.homepage',
            'primary.vehicles.single',
        ], ModelYearComposer::class);

        // State
        $this->app->view->composer([
            'primary.exclusive-services.index',
            'primary.used-vehicles.single',
        ], StateComposer::class);

        // Vehicle
        $this->app->view->composer([
            'primary.exclusive-services.index',
        ], ServiceVehicleComposer::class);

        //
        // CPanel
        //

        // Banner Position
        $this->app->view->composer([
            'cpanel.banners.create',
            'cpanel.banners.edit',
        ], BannerPositionComposer::class);

        // Page Field Position
        $this->app->view->composer([
            'cpanel.page-fields.create',
            'cpanel.page-fields.edit',
        ], PageFieldPositionComposer::class);

        // Page Position
        $this->app->view->composer([
            'cpanel.pages.create',
            'cpanel.pages.edit',
        ], PagePositionComposer::class);

        // Service Field Position
        $this->app->view->composer([
            'cpanel.service-fields.create',
            'cpanel.service-fields.edit',
        ], ServiceFieldPositionComposer::class);

        // Service Position
        $this->app->view->composer([
            'cpanel.services.edit',
        ], ServicePositionComposer::class);

        // Vehicle Accessory Position
        $this->app->view->composer([
            'cpanel.vehicle-accessories.create',
            'cpanel.vehicle-accessories.edit',
        ], VehicleAccessoryPositionComposer::class);

        // Vehicle Color Position
        $this->app->view->composer([
            'cpanel.vehicle-colors.create',
            'cpanel.vehicle-colors.edit',
        ], VehicleColorPositionComposer::class);

        // Vehicle Equipment Field Position
        $this->app->view->composer([
            'cpanel.vehicle-equipment-fields.create',
            'cpanel.vehicle-equipment-fields.edit',
        ], VehicleEquipmentFieldPositionComposer::class);

        // Vehicle Equipment Position
        $this->app->view->composer([
            'cpanel.vehicle-equipments.create',
            'cpanel.vehicle-equipments.edit',
        ], VehicleEquipmentPositionComposer::class);

        // Vehicle Maintenance Price Position
        $this->app->view->composer([
            'cpanel.vehicle-maintenance-prices.create',
            'cpanel.vehicle-maintenance-prices.edit',
        ], VehicleMaintenancePricePositionComposer::class);

        // Used Vehicle Photo Position
        $this->app->view->composer([
            'cpanel.used-vehicle-photos.create',
            'cpanel.used-vehicle-photos.edit',
        ], UsedVehiclePhotoPositionComposer::class);

        // Used Vehicle Position
        $this->app->view->composer([
            'cpanel.used-vehicles.create',
            'cpanel.used-vehicles.edit',
        ], UsedVehiclePositionComposer::class);

        // Vehicle Photo Position
        $this->app->view->composer([
            'cpanel.vehicle-photos.create',
            'cpanel.vehicle-photos.edit',
        ], VehiclePhotoPositionComposer::class);

        // Vehicle Accessory Type Position
        $this->app->view->composer([
            'cpanel.vehicle-accessory-types.create',
            'cpanel.vehicle-accessory-types.edit',
        ], VehicleAccessoryTypePositionComposer::class);

        // Vehicle Position
        $this->app->view->composer([
            'cpanel.vehicles.create',
            'cpanel.vehicles.edit',
        ], VehiclePositionComposer::class);

        // Vehicle Spec Field Position
        $this->app->view->composer([
            'cpanel.vehicle-spec-fields.create',
            'cpanel.vehicle-spec-fields.edit',
        ], VehicleSpecFieldPositionComposer::class);

        // Vehicle Spec Position
        $this->app->view->composer([
            'cpanel.vehicle-specs.create',
            'cpanel.vehicle-specs.edit',
        ], VehicleSpecPositionComposer::class);

        // Service Type
        $this->app->view->composer([
            'cpanel.services.create',
            'cpanel.services.edit',
        ], ServiceTypeComposer::class);

        // Used Vehicle Fuel
        $this->app->view->composer([
            'cpanel.used-vehicles.create',
            'cpanel.used-vehicles.edit',
        ], UsedVehicleFuelComposer::class);

        // Used Vehicle Gearbox
        $this->app->view->composer([
            'cpanel.used-vehicles.create',
            'cpanel.used-vehicles.edit',
        ], UsedVehicleGearboxComposer::class);

        // Vehicle Accessory Type
        $this->app->view->composer([
            'cpanel.vehicle-accessories.create',
            'cpanel.vehicle-accessories.edit',
        ], VehicleAccessoryTypeComposer::class);

        // Vehicle Colors
        $this->app->view->composer([
            'cpanel.vehicle-colors.create',
            'cpanel.vehicle-colors.edit',
        ], VehicleColorTypeComposer::class);

        // Vehicle
        $this->app->view->composer([
            'cpanel.vehicle-accessories.create',
            'cpanel.vehicle-accessories.edit',
            'cpanel.vehicles.create',
            'cpanel.vehicles.edit',
        ], VehicleComposer::class);

        // Vehicle Type
        $this->app->view->composer([
            'cpanel.vehicles.create',
            'cpanel.vehicles.edit',
        ], VehicleTypeComposer::class);

        // Yes Or No
        $this->app->view->composer([
            'cpanel.banners.create',
            'cpanel.banners.edit',
            'cpanel.vehicles.create',
            'cpanel.vehicles.edit',
            'cpanel.used-vehicles.create',
            'cpanel.used-vehicles.edit',
            'cpanel.services.create',
            'cpanel.services.edit',
            'cpanel.vehicle-colors.create',
            'cpanel.vehicle-colors.edit',
            'cpanel.vehicle-accessories.create',
            'cpanel.vehicle-accessories.edit',
            'cpanel.pages.create',
            'cpanel.pages.edit',
        ], YesOrNoComposer::class);

        // Vehicle Type Position
        $this->app->view->composer([
            'cpanel.vehicle-types.create',
            'cpanel.vehicle-types.edit',
        ], VehicleTypePositionComposer::class);
    }
}