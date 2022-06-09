
# A finit state machine works with laravel eloquent model


## Installation

You can install the package via composer:

```bash
composer require chareice/laravel-eloquent-fsm
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="eloquent-fsm-migrations"
php artisan migrate
```

## Usage

```php
use \Chareice\LaravelEloquentFSM\HasStateMachine;
use \Chareice\LaravelEloquentFSM\StateMachineModelInterface;


class Order extends Model implements StateMachineModelInterface {
    use HasStateMachine;
    
    public int $counter = 0;
    
    // define event
    public function events(): array
    {
        return [
            Event::builder()
                ->setName(OrderStateEvent::PAY)
                ->setFrom(OrderState::PENDING)
                ->setTo(OrderState::PAID)
                ->setAfter(function () {
                    $this->counter = 1;
                })
                ->build(),

            Event::builder()
                ->setName(OrderStateEvent::SHIP)
                ->setFrom(OrderState::PAID)
                ->setTo(OrderState::SHIPPED)
                ->build(),
        ];
    }   
}

$order = Order::first();

// run event
$order->getStateMachine()->runEvent(OrderStateEvent::PAY);


// check new state
$order->getStateMachine()->getCurrentState(); // equals OrderState::PAID

// check event log
$order->stateMachineLogs()->first();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Chareice](https://github.com/chareice)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
