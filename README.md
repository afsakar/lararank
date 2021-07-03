# LaraRank

Laravel 8 starter pack

## Installation

* Clone the repo and <code>cd</code> into it
* Run <code>composer install</code>
* Rename or copy <code>.env.example</code> file to <code>.env</code>
* Run <code>php artisan key:generate</code>
* Set your database credentials in your <code>.env</code> file
* Run <code>php artisan migrate</code> and <code>php artisan db:seed</code>

## Features

### 1) Menu

Dynamically, the menus are composed of the <code>config/menu.php</code> file.


> **Important note!**
> *Important note! Since the permissions section is based on this file, you must add at least one action to each module. When you creating a drop-down menu, you do not have to give the route and gate in the menu title.*

Example;

```jsonld=
...

[
    'title' => 'Works',
    'gate' => 'works',
    'route' => '',
    'is_active' => '',
    'description' => 'Work List',
    'icon' => 'fas fa-rocket',
    'permissions' => '',
    'submenus' => [
        [
            'title' => 'Work List',
            'gate' => 'works',
            'route' => 'works',
            'is_active' => '',
            'description' => '',
            'permissions' => [
                'read' => 'Read',
                'create' => 'Create',
                'update' => 'Update',
                'delete' => 'Delete'
            ],
        ],
        [
            'title' => 'New Work',
            'gate' => 'works.create',
            'route' => 'works.create',
            'is_active' => '',
            'description' => '',
            'permissions' => [
                'read' => 'Read',
                'create' => 'Create',
                'update' => 'Update',
                'delete' => 'Delete'
            ],
        ]
    ]
],

...
```

### 2) Roles & Permissions

You can authorize users directly or through the role.

To authorize a user with the help of a role, leave all the options in the authorization tab of the user editing page blank.

#### Route usage;

```injectablephp=

Route::get('/users/create', [UserController::class, 'create'])->middleware('PermissionCheck:users,create')->name('users.create'); 

```

#### View usage;

To manage permissions through the view, simply call the function called permission_check().

You can find this function in the file at app/Http/Helpers.php.

The function takes two parameters. The first parameter is the "gate" value of the menu items in the config/menu.php file. The other parameter specifies the actions in the "permissions" parameters in the same menu file.


```injectablephp=

@if(permission_check('users', 'create'))
    <div class="section-header-button">
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> Kullanıcı Ekle
        </a>
    </div>
@endif

```

> **Important note!** 
> If at least one authorization is marked on the user-specific authorization page, the user will be subject to authorization control according to the data coming from here.

### 3) Layouts

You can use layout file from ```resources/views/layouts/admin.blade.php```

```injectablephp=

    <x-admin-layout>
    
        <x-slot name="header">
            Page Title
        </x-slot>
    
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Page Title</h1>
                </div>
    
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                
                                    Page Content
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    
    </x-admin-layout>


```

### 4) User Activity Logs

Here the ```spatie/laravel-activitylog``` package was used. You can check [here](https://github.com/spatie/laravel-activitylog) for how to use.

```injectablephp=
    ...
    
    use Spatie\Activitylog\Traits\LogsActivity;
    
    class User extends Authenticatable
    {
    use LogsActivity;

    /**
     * @var array
     */
    protected static $logAttributes = ['name', 'email', 'role_id'];

    /**
     * @var bool
     */
    protected static $logOnlyDirty = true; 
    
    /* 
    true, it will save only the changed data while updating.
    false, it will also save the unchanged data in updates.
    */

    /**
     * @var bool
     */
    protected static $submitEmptyLogs = false;
    
    ...
}

```

## Packages

* Admin Template =>  [Stisla Admin Dashboard](https://getstisla.com/)
* JetStrap =>  [nascent-africa/jetstrap](https://github.com/nascent-africa/jetstrap)
* User Activity Logs =>  [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog)
* Log Viewer =>  [rap2hpoutre/laravel-log-viewer](https://github.com/rap2hpoutre/laravel-log-viewer)
