# SagoBoot

**SagoBoot** | The mini-framework for scalable PHP application

There is no principle when using this package or any, just blump your mind

## The key archive

**SagoBoot**, which designed small enough to inject in any complex and not highly architect such as WordPress, Drupal ...
using for theming and plugins.

**SagoBoot**, which designed to scale up more efficiently, by using `Composer packages` and `PSR-4: Autoloader`,
out of the box, you can use it beside `Symfony` or `Zend` for the first routing or destructor ...

**SagoBoot**, which designed for ease to use, quicky start, flexible and compatible for any idea and projects.

## Installation

Install from `Composer` 

    composer require haihv433/sagoboot

Or just clone repo from `github`

    git clone git@github.com:haihv433/sagoboot.git

## Application and Loader

The first important thing when creating your own application is the `App` class manager, which holds all the instances

See class [`SagoBoot\Sample\App\App`](https://github.com/haihv433/sagoboot/blob/master/sample/App/App.php) for a sample

Your Application Manager needs to extend from `\SagoBoot\Application`

In your [`bootstrap.php`](https://github.com/haihv433/sagoboot/blob/master/sample/bootstrap.php) 
you can control when your application booting, such as add Autoloader

    // Initlize your application
    $app = new \SagoBoot\Sample\App\App();
    
    // Set your new class as App manager
    // that then, your system will cheat \SagoBoot\Sample\App as a Manager instead of \SagoBoot\Application
    $app->bind('SagoBoot\Sample\App', 'App', 1);
    
    // SagoBoot do call your Loader when system boot
    // Before that, you can add the logic more
    $app->addEvent('boot', function ( \SagoBoot\Sample\App\Loader $loader) use ($app) {
        $app->make('Autoload')->addLoader($loader);
    });

Look at your own sample loader [`\SagoBoot\Sample\App\Loader`](https://github.com/haihv433/sagoboot/blob/master/sample/bootstrap.php)

    // This method will call automatically when system boot
    public function autoload(Modules\Loader $loader)
    {
        $loader->loadPath(__DIR__ . '/../autoload.php');
    }
    
As you see, `Loader` using a file named `autoload.php`, take a look of this those lines:

    [
        'abstract' => \SagoBoot\Sample\Car\Car::class, 
        'make' => false, 
        'singleton' => true, 
        'aliases' => [ 
            \SagoBoot\Sample\Car\CarInterface::class
         ]
    ]

The file contains an array, each element has configuration:

`abstract`: Define your class

`make`: Set `true` if your want system constructs them automatically, or otherwise.

`singleton`: Set instances as Singleton that allow accessing as the same

`aliases`: You can hide your real logic when using `aliases` pattern, check class 
[`\SagoBoot\Sample\Car\CarInterface`](https://github.com/haihv433/sagoboot/blob/master/sample/Car/CarInterface.php) 
for a sample. 

Finally, don't forget to boot your system.
    
    $app = require_once(__DIR__ . "/sample/bootstrap.php");
    // Now booting
    $app->boot();
    
    
## Dependency Injection

Now, if you'd finished declaring your Application, no more effort to construct your class, just inject any class you needed

The `MakeCar` sample class

    namespace SagoBoot\Sample;
    
    class MakeCar
    {
        public function __construct(
            \SagoBoot\Sample\Garage $garage,
            \SagoBoot\Sample\Car\CarInterface $car
        )
        {
        }
    }

the `Garage` sample class

    namespace SagoBoot\Sample;
    
    class Garage
    {
        /**
         * @var \SagoBoot\Sample\Car\CarInterface
         */
        protected $car;
    
        public function __construct(
            \SagoBoot\Sample\Car\CarInterface $car
        )
        {
            $this->car = $car;
        }
    }

As you see above, no need to add  the `new` keyword when create class, which is already set in `autoload.php` 

The Application also check the `aliases` for a reflection from real class to alias

In this case, calling interface `\SagoBoot\Sample\Car\CarInterface` will return an instance of `\SagoBoot\Sample\Car\Car`

## Singleton

If you set your class as `singleton` in `autoload.php` or `implements` from `\SagoBoot\Support\Singleton`, your Application will 
treat what one as `Singleton` object, that mean, calling or injection will return the same object.

See this in `MakeCar.php::__construct()`

        $car->start()
            ->observerState()
            ->addFuel()
            ->observerState()
            ->stop();

        $garage->maintenanceCar();

        $car->observerState();

By running command `php index.sample.php`

Output: 

    Your car is: RUNNING.
    Your car is: REFUEL.
    Your car is: RUNNING.
    Your car is: MAINTENANCE.
    The car was destroyed.

For calling the instance of `Car` class, these methods could useful:

+ Inject the interface `\SagoBoot\Sample\Car\CarInterface` in constructor
+ Calling `\SagoBoot\Sample\App\App::getInstance()->make(\SagoBoot\Sample\Car\CarInterface::class)`
+ `sgb_app(\SagoBoot\Sample\Car\CarInterface::class)` (check API)

## Event

If you are noted, your application only boots when call `$app->boot()`, 
look more closely in this method: 

    $this->make('EventsHelper')->fire('boot');
    
The event `boot` is a system designed for booting, for that, you can add your custom logic after or before system boot, 
see this:

    $app->addEvent('your_custome_event', function() {
          // Your logical
    });
        
    $app->addEvent('boot', function() {
        
        $this->make('EventsHelper')->fire('your_custome_event');
    })
    
## API Functional

For more convenient when interact with your application, please check [`helpers.php`](https://github.com/haihv433/sagoboot/blob/master/src/helpers.php)
for more options:

+ Create or retrieve an instance `sgb_app()`
+ Call a `Helper` object `sgb_helper()`, (any class has name ending by `Helper` keyword)
+ Event `sgb_event()` and `sgb_add_event()`
+ Filter `sgb_filter` and `sgb_add_filter()` 

## Practical
Do you love design pattern and how to implement them all, those articles might useful
+ [DesignPatternsPHP](https://designpatternsphp.readthedocs.io/)
+ [Source Marking](https://sourcemaking.com/design_patterns)

There is no principle when implement `SagoBoot` with any pattern, Factory, Proxy, Repo ... whatever, you already have a skeleton, just do it !!!