<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class MakeRepositoryModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repository:model {CLASS_NAME}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an entity Model';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $className = $this->argument('CLASS_NAME');
        $stubContent = $this->getStubContent();
        $fileName = $className . '.php';
        $stubContent = str_replace('$NAMESPACE$', $this->resolveModelNamespace(), $stubContent);
        $stubContent = str_replace('$CLASS_NAME$', $className, $stubContent);


        $filePath = $this->getModelFilePath();
        $this->info($filePath);
        if(File::exists($filePath)) {
            $this->error("This file already exist: $fileName");
        }
        $this->info("PHP file generated successfully: $fileName");
        File::put($filePath, $stubContent);
    }

    private function getStubContent(): string
    {
        $stubPath = base_path('stubs/model.stub');
        return File::get($stubPath);
    }

    private function getModelFilePath( ): string {
        $className = $this->argument('CLASS_NAME');
        return $this->getModelDirectory() . '/' . $className .'.php' ;
    }

    private function getModuleDirectory(): string {
        $moduleDirectory = Config::get('module.default');
        $folderPath = app_path($moduleDirectory);
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
            $this->info("Create $moduleDirectory module directory.");
        }
        $this->info($folderPath);
        return $folderPath;
    }

    private function getModelDirectory(): string {
        $className = $this->argument('CLASS_NAME');
        $folderPath = $this->getModuleDirectory() . '/' . $className;
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true, true);
            $this->info("Create $className feature directory.");
        }
        return $folderPath;
    }

    private function resolveModelNamespace(): string {
        $className = $this->argument('CLASS_NAME');
        $moduleDirectory = Config::get('module.default');
        return implode('\\',['App', $moduleDirectory, $className]);
    }
}
