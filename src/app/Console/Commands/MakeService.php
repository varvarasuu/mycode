<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class and interface';
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();
        $this->filesystem = $filesystem;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $segments = explode('/', $name);
        $serviceName = array_pop($segments);
        $namespace = $this->getNamespace() . '\\' . implode('\\', $segments);

        $serviceDirectory = app_path("Services/" . implode('/', $segments));
        $this->makeDirectory($serviceDirectory);

        $servicePath = $serviceDirectory . "/{$serviceName}.php";
        $this->makeService($servicePath, $namespace, $serviceName);

        $interfacePath = $serviceDirectory . "/{$serviceName}Interface.php";
        $this->makeInterface($interfacePath, $namespace, $serviceName);

        $this->info('Service and Interface created successfully.');
    }

    protected function getNamespace()
    {
        return 'App\Services';
    }

    protected function makeDirectory($path)
    {
        if (!$this->filesystem->isDirectory($path)) {
            $this->filesystem->makeDirectory($path, 0755, true);
        }
    }

    protected function makeService($path, $namespace, $name)
    {
        $stub = $this->filesystem->get(__DIR__ . '/stubs/service.stub');
        $stub = str_replace(['{{serviceNamespace}}', '{{interfaceNamespace}}', '{{class}}', '{{interface}}'], [$namespace, $namespace, $name, $name . 'Interface'], $stub);
        $this->filesystem->put($path, $stub);
    }

    protected function makeInterface($path, $namespace, $name)
    {
        $interfaceStub = $this->filesystem->get(__DIR__ . '/stubs/interface.stub');
        $interfaceStub = str_replace(['{{interfaceNamespace}}', '{{interface}}'], [$namespace, $name . 'Interface'], $interfaceStub);
        $this->filesystem->put($path, $interfaceStub);
    }
}
