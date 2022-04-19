<?php

namespace Milyoonex\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;

class MakeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {--m|mongo} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a Repository with Facade';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $getStubsWithData = $this->getStubsWithData();

        foreach ($getStubsWithData as $data) {
            if (! file_exists($data['path'])) {
                file_put_contents($data['path'], $data['content']);
                $this->info($data['stub'] . ' created successfully.');
            } else {
                $this->error($data['stub'] . ' already exits!');
            }
        }
    }

    protected function getSingularClassName($name): string
    {
        $repositoryName = ucwords(Pluralizer::singular($name));

        if($this->option('mongo')) {
            if(! str_contains($repositoryName, 'MongoRepository')) {
                $repositoryName = $repositoryName . 'MongoRepository';
            }
        } else {
            if(! str_contains($repositoryName, 'Repository')) {
                $repositoryName = $repositoryName . 'Repository';
            }
        }

        return $repositoryName;
    }

    protected function getStubInformation(): array
    {
        $repositoryName = $this->getSingularClassName($this->argument('name'));
    
        return [
            ($this->option('mongo')) 
            ? __DIR__ . '/../../../stubs/mongo_repository.stub'
            : __DIR__ . '/../../../stubs/mysql_repository.stub' 
            => 
            [
                'variables' => ['class' => $repositoryName],
                'path'      => base_path('app/Repositories/') . $repositoryName . '.php',
                'stub'      => ($this->option('mongo')) ? 'MongoRepository' : 'Repository'
            ],
            ($this->option('mongo')) 
            ? __DIR__ . '/../../../stubs/mongo_facade.stub'
            : __DIR__ . '/../../../stubs/mysql_facade.stub'  
            => 
            [
                'variables' => ['class' => $repositoryName . 'Facade', 'see' => $repositoryName],
                'path'      => base_path('app/Facades/') . $repositoryName . 'Facade.php',
                'stub'      => ($this->option('mongo')) ? 'MongoFacade' : 'Facade'
            ]
        ];
    }

    protected function getStubsWithData(): array|bool|string
    {
        $stubs = $this->getStubInformation();
        //dd($stubs);
        $stubsWithData = [];
        $index = 0;
        foreach ($stubs as $stub => $data) {
            $this->makeDirectory(dirname($data['path']));

            $content = file_get_contents($stub);
            foreach ($data['variables'] as $search => $replace)
            {
                $content = str_replace( '{{ '.$search.' }}' , $replace, $content);
            }
            $stubsWithData[$index] = ['stub' => $data['stub'], 'path' => $data['path'], 'content' => $content];
            $index++;
        }

        return $stubsWithData;
    }

    protected function makeDirectory($path)
    {
        if (! is_dir($path)) {
            mkdir($path, 0777, true);
        }

        return $path;
    }
}
