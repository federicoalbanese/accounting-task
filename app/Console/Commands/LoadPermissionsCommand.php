<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\User\Entities\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class LoadPermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'load all permissions base on Action names';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $routes             = Route::getRoutes();
        $notMindMethodNames = ['__invoke', '__construct'];
        $actions            = Permission::query()->pluck('action')->toArray();
        $newActions         = [];
        /** @var \Illuminate\Routing\Route $route */
        foreach ($routes as $route) {
            $actionName = $route->getActionName();
            if ($actionName !== 'Closure') {
                $controllerNameFQN = explode('@', $actionName)[0];
                $methodName        = explode('@', $actionName);
                if (count($methodName) > 1) {
                    $methodName = $methodName[1];
                    if (!\in_array($methodName, $notMindMethodNames) && str_ends_with($methodName, 'Action')) {
                        $controllerName = explode('\\', $controllerNameFQN);
                        $controllerName = $controllerName[count($controllerName) - 1];
                        $controllerName = str_replace('Controller', '', $controllerName);

                        $beautifiedControllerName = $this->splitWords($controllerName);
                        $beautifiedMethodName     = $this->splitWords($methodName);
                        $beautifiedMethodName     = str_replace(' Action', '', $beautifiedMethodName);

                        $actionTitle = $beautifiedControllerName.' -> '.ucwords($beautifiedMethodName);

                        if ( !\in_array($actionName, $actions) && !\in_array($actionName, $newActions)) {
                            $permission         = new Permission();
                            $permission->action = $actionName;
                            $permission->title  = $actionTitle;
                            $permission->save();
                            $newActions[] = $actionName;

                            $this->output->success($actionTitle.' == '.$actionName);
                        }
                    }
                }
            }
        }

        return Command::SUCCESS;
    }

    /**
     * @param string $subject
     *
     * @return string
     */
    private function splitWords(string $subject): string
    {
        $subjectWords = preg_split('/(?=[A-Z])/', $subject);

        return trim(implode(' ', $subjectWords), ' ');
    }
}
