<?php

namespace FormBuilder\Providers;

use FormBuilder\Models\Form;
use FormBuilder\Models\Role;
use FormBuilder\Models\Question;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use FormBuilder\Models\Restriction;
use FormBuilder\Models\Answer;
use FormBuilder\Models\User;
use Illuminate\Http\Request;
use FormBuilder\Common\OnlyTrashed;

class RouteServiceProvider extends ServiceProvider
{
    use OnlyTrashed;
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'FormBuilder\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();

        Route::bind('role', function($value){
            $query = Role::query();
            $request =  app(Request::class);
            $query = $this->onlyTrashedIfRequested($request, $query);
            $collection = Role::whereId($value)->orWhere('slug',$value)->get();
            return $collection->first();
        });

        Route::bind('form', function($value){
            $query = Form::query();
            $request =  app(Request::class);
            $query = $this->onlyTrashedIfRequested($request, $query);
            $collection = Form::whereId($value)->orWhere('slug',$value)->get();
            return $collection->first();
        });

        Route::bind('question', function($value){
            $query = Question::query();
            $request =  app(Request::class);
            $query = $this->onlyTrashedIfRequested($request, $query);
            $collection = Question::whereId($value)->orWhere('slug',$value)->get();
            return $collection->first();
        });

        Route::bind('restriction', function($value){
            $query = Restriction::query();
            $request =  app(Request::class);
            $query = $this->onlyTrashedIfRequested($request, $query);
            $collection = Restriction::whereId($value)->orWhere('slug',$value)->get();
            return $collection->first();
        });

        Route::bind('user', function($value){
            $query = User::query();
            $request =  app(Request::class);
            $query = $this->onlyTrashedIfRequested($request, $query);
            return $query->find($value);
        });

    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
