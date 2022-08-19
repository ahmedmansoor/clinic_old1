<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class CustomGeneratorCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-custom {prefix} {name} {stub} {type} {path} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check GenerateBoilerplate';

    public function handle()
    {
        $this->type = $this->argument('type');

        return parent::handle();
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $folder = $this->argument('path');
        
        return base_path() . '/' . $folder . str_replace('\\', '/', $name) . '.php';
    }

    public function getStub()
    {
        $stub = '/stubs/' . $this->argument('stub');
        return $this->resolveStubPath($stub);
    }

    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
        ? $customPath
            : __DIR__ . $stub;
    }

    protected function buildClass($name)
    {
        //RoomService
        $prefix = $this->argument('prefix');

        //RoomService to room_service
        $snakeCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $prefix));
        //room_services
        $pluralSnakeCase = Str::snake(Str::plural($snakeCase));
        
        //RoomService to room-service
        $kebabCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $prefix));
        //room-services
        $pluralKebabCase = Str::kebab(Str::plural($kebabCase));

        $replace = [
            '{{ prefix }}' => $prefix,
            '{{ prefix_snake_case }}' => $snakeCase,
            '{{ prefix_plural_snake_case }}' => $pluralSnakeCase,
            '{{ prefix_plural_kebab_case }}' => $pluralKebabCase,
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }
}
