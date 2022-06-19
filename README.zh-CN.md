[English](./README.md) | 简体中文

# Laravel Eloquent 适用的有限状态机

## 安装

通过 composer 命令进行安装：
```bash
composer require chareice/laravel-eloquent-fsm
```

发布 migration 文件到 Laravel 项目中

```bash
php artisan vendor:publish --tag="eloquent-fsm-migrations"
php artisan migrate
```

## 使用

```php
use \Chareice\LaravelEloquentFSM\HasStateMachine;
use \Chareice\LaravelEloquentFSM\StateMachineModelInterface;


class Order extends Model implements StateMachineModelInterface {
    use HasStateMachine;
    
    public int $counter = 0;
    
    // 定义事件
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

// 运行事件
$order->getStateMachine()->runEvent(OrderStateEvent::PAY);


// 检查新状态
$order->getStateMachine()->getCurrentState(); // 等于 OrderState::PAID

// 检查状态迁移日志
$order->stateMachineLogs()->first();
```

## 测试

```bash
composer test
```

## Credits

- [Chareice](https://github.com/chareice)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
