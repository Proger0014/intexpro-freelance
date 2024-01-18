<?php

namespace App\Api\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand as Command;

class ModelMakeCommand extends Command
{
    protected function getDefaultNamespace($rootNamespace)
    {
        return "{$rootNamespace}\\Infrastructure\\Data\\Models";
    }
}