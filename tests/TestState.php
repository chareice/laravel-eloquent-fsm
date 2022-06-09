<?php

namespace Chareice\LaravelEloquentFSM\Tests;

enum TestState: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case WAITING_FOR_SHIP = 'waiting-for-ship';
    case SHIPPED = 'shipped';
}
