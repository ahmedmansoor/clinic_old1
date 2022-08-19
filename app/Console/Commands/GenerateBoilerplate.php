<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;

class GenerateBoilerplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:boiler-plate {prefix} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * 
     * @todo after generating remember to modify fields on factory and test
     * @todo after generating remember to modify StoreRequest rules method array(add the fields)
     * @todo after generating remember to modify UpdateRequest rules method array(add the fields)
     * 
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prefix = $this->argument('prefix');

        // path is for file folder path eg. app/Http/Controllers/SomeController.php
        $specs = [
            [ 'type' => 'StoreRequest',  'stub' => 'custom-api-store-request.stub',  'path' => 'app/Http/Requests/API/', ],
            [ 'type' => 'UpdateRequest', 'stub' => 'custom-api-update-request.stub', 'path' => 'app/Http/Requests/API/', ],
            [ 'type' => 'Controller',    'stub' => 'custom-api-controller.stub',     'path' => 'app/Http/Controllers/API/',],
            [ 'type' => 'Repository',    'stub' => 'custom-repository.stub',         'path' => 'app/Repositories/',],
            [ 'type' => 'Model',         'stub' => 'custom-model.stub',              'path' => 'app/Models/',],
            [ 'type' => 'Factory',       'stub' => 'custom-factory.stub',            'path' => 'database/factories/',],
            [ 'type' => 'Seeder',        'stub' => 'custom-seeder.stub',             'path' => 'database/seeders/',],
            [ 'type' => 'Resource',      'stub' => 'custom-api-resource.stub',       'path' => 'app/Http/Resources/',],
            [ 'type' => 'Collection',    'stub' => 'custom-api-collection.stub',     'path' => 'app/Http/Resources/',],
            [ 'type' => 'Test',          'stub' => 'custom-api-crud-test.stub',      'path' => 'tests/Feature/API/',],
        ];
    
        foreach ($specs as $params) {

            // if its a test file, then we need to create a seperate folder named model
            if ($params['type'] == 'Test') {
                $params['path'] = $params['path'] . $prefix . '/';
            }

            $params = array_merge($params, [
                'name' => ($params['type'] != 'Model') ? $prefix . $params['type'] : $prefix, // name is for filename eg. SomeController.php
                'prefix' => $prefix, //eg. {{ prefix }}Controller extends Controller
                '--force' => $this->option('force'), //to replace existing file
            ]);

            $this->call('generate-custom', $params);
        }

        $this->info('Boilerplates generated successfully.');

        // add routes to routes/api.php file
        // import use statement to routes/api.php file
        $controller = $prefix . 'Controller';
        $this->importControllerToRoutes($controller);
        // add resource route to routes/api.php file
        $kebabCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $prefix));
        $resource  = Str::kebab(Str::plural($kebabCase));
        $this->addResourceRouteToRoutes($resource, $controller);

        // add seeder to database/Seeders/DatabaseSeeder.php file
        $this->addSeederToDatabaseSeeder($prefix);
    }

    protected function importControllerToRoutes($controller)
    {
        $lineToInsert = "use App\\Http\\Controllers\\API\\".$controller.";";
        $lookForLast = "use ";
        $this->addNewLineAfterSpecificLine(
            base_path('routes/api.php'),
            $lineToInsert,
            $lookForLast,
            'Imported controller to routes/api.php.',
            'Controller already imported to routes/api.php.'
        );
    }

    protected function addResourceRouteToRoutes($resource, $controller)
    {
        $lineToInsert = "    Route::resource('".$resource."', ".$controller."::class);";
        $lookForLast = "Route::group(['middleware' => 'auth:sanctum";
        $this->addNewLineAfterSpecificLine(
            base_path('routes/api.php'),
            $lineToInsert,
            $lookForLast,
            'Added resource route to routes/api.php.',
            'resource route already added to routes/api.php.'
        );
    }

    protected function addSeederToDatabaseSeeder($prefix)
    {
        $lineToInsert = '        $this->call('.$prefix.'Seeder::class);';
        $lookForLast = 'Seeder::class);';
        $this->addNewLineAfterSpecificLine(
            base_path('database/seeders/DatabaseSeeder.php'),
            $lineToInsert,
            $lookForLast,
            'Added seeder call to database/seeds/DatabaseSeeder.php.',
            'Seeder call already added to database/seeds/DatabaseSeeder.php.',
            'end'
        );
    }

    protected function addNewLineAfterSpecificLine(
        $filename,
        $lineToInsert,
        $lookForLast,
        $successMessage = 'Added new line to file.',
        $errorMessage = 'New line already added to file.',
        $whereInLine = 'start'
        )
    {
        $lines = file($filename, FILE_IGNORE_NEW_LINES);
        
        //find the last line which starts with lookFor
        // also while doing that check if the lineToInsert is already present in the file
        $insertAfterThisLine = 0;
        foreach ($lines as $number => $line) {

            if ($line == $lineToInsert) {
                $this->error($errorMessage);
                return;
            }

            if ($whereInLine == 'start') {
                if (Str::startsWith($line, $lookForLast)) {
                    $insertAfterThisLine = $number;
                }
            } else {
                if (Str::endsWith($line, $lookForLast)) {
                    $insertAfterThisLine = $number;
                }
            }
        }

        //put the line $lineToInsert after the $lookForLast
        $newLines = array();
        foreach ($lines as $number => $line) {
            if ($number < $insertAfterThisLine) {
                $newLines[$number] = $line;
            } else if ($number == $insertAfterThisLine) {
                $newLines[$number] = $line;
                $newLines[$number + 1] = $lineToInsert;
            } else if ($number > $insertAfterThisLine) {
                $newLines[$number + 1] = $line;
            }
        }

        //write the new one to routes file
        file_put_contents($filename, implode("\n", $newLines));
        // dump($newLines);
        $this->info($successMessage);
    }
}
