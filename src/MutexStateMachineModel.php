<?php

namespace Chareice\LaravelEloquentFSM;

interface MutexStateMachineModel extends StateMachineModelInterface
{
    public function refresh();

    public function getId();
}
