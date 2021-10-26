<?php

use App\Repositories\{Banner\BannerRepositoryInterface,
    Banner\BannerRepository,
    Banner\CachedBannerRepository,
    Direction\CachedDirectionRepository,
    Direction\DirectionRepository,
    Direction\DirectionRepositoryInterface,
    City\CachedCityRepository,
    City\CityRepository,
    City\CityRepositoryInterface,
    EntitySection\CachedEntitySectionRepository,
    EntitySection\EntitySectionRepository,
    EntitySection\EntitySectionRepositoryInterface,
    Format\CachedFormatRepository,
    Format\FormatRepository,
    Format\FormatRepositoryInterface,
    Landing\CachedLandingRepository,
    Landing\LandingRepository,
    Landing\LandingRepositoryInterface,
    Person\CachedPersonRepository,
    Person\PersonRepository,
    Person\PersonRepositoryInterface,
    Product\CachedProductRepository,
    Product\ProductRepository,
    Product\ProductRepositoryInterface,
    Organization\CachedOrganizationRepository,
    Organization\OrganizationRepository,
    Organization\OrganizationRepositoryInterface,
    Subject\CachedSubjectRepository,
    Subject\SubjectRepository,
    Subject\SubjectRepositoryInterface
};


return [
    [
        'interface'      => BannerRepositoryInterface::class,
        'implementation' => BannerRepository::class,
        'cache'          => CachedBannerRepository::class,
    ],
    [
        'interface'      => ProductRepositoryInterface::class,
        'implementation' => ProductRepository::class,
        'cache'          => CachedProductRepository::class,
    ],
    [
        'interface'      => OrganizationRepositoryInterface::class,
        'implementation' => OrganizationRepository::class,
        'cache'          => CachedOrganizationRepository::class,
    ],
    [
        'interface'      => DirectionRepositoryInterface::class,
        'implementation' => DirectionRepository::class,
        'cache'          => CachedDirectionRepository::class,
    ],
    [
        'interface'      => SubjectRepositoryInterface::class,
        'implementation' => SubjectRepository::class,
        'cache'          => CachedSubjectRepository::class,
    ],
    [
        'interface'      => FormatRepositoryInterface::class,
        'implementation' => FormatRepository::class,
        'cache'          => CachedFormatRepository::class,
    ],
    [
        'interface'      => CityRepositoryInterface::class,
        'implementation' => CityRepository::class,
        'cache'          => CachedCityRepository::class,
    ],
    [
        'interface'      => LandingRepositoryInterface::class,
        'implementation' => LandingRepository::class,
        'cache'          => CachedLandingRepository::class,
    ],
    [
        'interface'      => PersonRepositoryInterface::class,
        'implementation' => PersonRepository::class,
        'cache'          => CachedPersonRepository::class,
    ],
    [
        'interface'      => EntitySectionRepositoryInterface::class,
        'implementation' => EntitySectionRepository::class,
        'cache'          => CachedEntitySectionRepository::class,
    ],
];
