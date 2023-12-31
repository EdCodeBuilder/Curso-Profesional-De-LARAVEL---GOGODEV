# Notas de curso de Laravel
***
## Tabla de contenido
- [Notas de curso de Laravel](#notas-de-curso-de-laravel)
  - [Tabla de contenido](#tabla-de-contenido)
  - [Arquitectura del proyecto](#arquitectura-del-proyecto)
  - [Estructura del proyecto](#estructura-del-proyecto)
  - [Generación de proyecto laravel 9.0](#generación-de-proyecto-laravel-90)
  - [Configuración de la capa de persistencia](#configuración-de-la-capa-de-persistencia)
  - [Migraciones](#migraciones)
  - [Rollback](#rollback)
  - [Modelos](#modelos)
  - [Comandos combinados](#comandos-combinados)
  - [Vinculacion Ruta-Controlador-Vista](#vinculacion-ruta-controlador-vista)
  - [Consultas a modelos, paso de informacion y pintado](#consultas-a-modelos-paso-de-informacion-y-pintado)
  - [Insersion de datos](#insersion-de-datos)
  - [Eloquent](#eloquent)
  - [SQL Raw](#sql-raw)
  - [Rutas con parametros](#rutas-con-parametros)
  - [CRUD](#crud)
  - [Validacion y custom request](#validacion-y-custom-request)
  - [Gestion de errores y mensajes de sesion](#gestion-de-errores-y-mensajes-de-sesion)
  - [Rutas y controladores resource](#rutas-y-controladores-resource)
  - [API](#api)

***
## Arquitectura del proyecto
- Laravel por defecto soporta el patron de arquitectura **MVC**, pero tambien puede soportar otras arquitecturas.


![Arquitectura del proyecto](Patron%20de%20arquitectura%20de%20proyecto.jpg)


1. El cliente solicita información atravez de la **Ruta** (URI + método HTTP).
2. Cada Ruta esta relacionada con un **Controlador**.
3. El **Controlador** va tener la lógica sobre las peticiones y va a realizar la gestión de la petición.
4. El **Controlador** gestiona las peticiones a los Modelos, le pide al **Modelo** todos los datos que necesite.
5. El **Modelo** es la representacion en una clase de las tablas que se van a tener en la DB
6. El **Modelo** de una forma *agnostica* a el *sistema de persistencia*, es decir, sin necesidad de tener que ejecutar alguna petición SQL, devuelve la información al Controlador
7. La ejecucion de un **ORM** permite la solicitud de la información por parte del Modelo a la DB
   - El ORM por defecto de laravel es **Eloquent** pero se puede llegar a configurar otro ORM si se requiere (p.e. Doctrine).
   - Eloquent utiliza patron de Active Record, Doctrine utiliza un patron de Data Mapper.
8.  Cuando el Controlador tiene ya toda la informacion de los Modelos, está listo para servirla al cliente, esto se puede hacer a travez de una API si se trabaja laravel solo como parte del Backend o puede realizarse a travez de las Vistas .blade.php si el proyecto esta pensado como un monolito en laravel o un desarrollo fullstack.
- Los **Middleware** se ubican en las peticiones entre la Ruta y el Controlador, realiza comprobaciones antes de ejecutar un Controlador (p.e. verificar si un usuario esta loggeado antes de consumir un Controlador, de lo contrario derivarlo a la Ruta loggin).
- Los **Observadores** se ubican entre los Controladores y los Modelos, verifican cuando ocurren diferentes acciones y actuan en consecuencia (p.e. si tenemos un e-commerce, se podria tener un Observador que observe cuando se realiza una nueva compra y genere una factura).

## Estructura del proyecto
- **.env** : archivo de configuraciones de entorno.
- **./routes** : carpeta donde se encuentran los archivos para las rutas, asocian cada URL a su correspondiente controlador.
  - **./routes/api** = para las rutas API.
  - **./routes/web** = para las rutas URL web, arquitectura en monolito, Laravel entrega tambien las vistas.
- **./resources/views** : carpeta donde se encuentran todas las vistas que va a servir Laravel.
- **./app/models** : carpeta donde se encuentran todos los modelos de la aplicación.
- **./app/controllers** : carpeta donde se encuentran todos los controladores.

## Generación de proyecto laravel 9.0
- ```composer create-project laravel/laravel:^9.x project-name```

## Configuración de la capa de persistencia
- **./database/migrations** : Laravel debe incluir la logica y los ficheros necesarios para construir todo el sistema de persistencia de forma agnositca, es decir que no se ejecuten consultas SQL directamente.
- **.env** : en el archivo (env -> environment) se van a incluir todos datos de conexión a todos los sistemas de infraestructura.
- Para la ejecucion de acciones en el sistema de pertisistencia se ejecuta el comando ```php artisan migrate``` este comando ejecuta los archivos de migracion que aun no se hubieran ejecutado.

## Migraciones
- La tabla **migrations** generada por laravel hace referencia al control de archivos que ha migrado.
- El comando ```php artisan make:migration``` genera un archivo de migracion.
- En el sigiente ejemplo, la convencion ```php artisan make:migration create_notes_table``` vemos que es una tabla notas, por convencion las tablas en migraciones se mencionan en plural.
- Al generarse el archivo de migracion se pueden identificar 2 funciones principales up() y down(), los cuales se usan cuando se van a levantar o bajar estas tablas de nuestra DB y contienen toda la logica para ello, tambien podemos identificar el uso de la clase ```Schema``` que contiene diferentes metodos estáticos, por esa razon se accede con ellos con "::" por ejemplo ```Schema::create()``` para mas informacion se puede consultar el siguiente [link](https://laravel.com/api/9.x/Illuminate/Database/Schema/Builder.html).
- **SIEMPRE** la crear un archivo de migracion hay que ejecutar el comando ```php artisan migrate```.

## Rollback
- **Rollbacking** : tirar hacia atras un lote (batch) de migraciones. Para hacer un rollback de la ultima migración se puede ejecutar el siguiente comando ```php artisan migrate:rollback```
- ```php artisan migrate:reset``` tira hacia atras todas las migraciones hechas.
- ```php artisan migrate:rollback --batch=``` tira hacia atras ese lote de migracion específico.
- ```php artisan migrate:refresh``` realiza un *reset* e inmediatamente un *migrate*.
- ```php artisan make:migration update_notes_table``` con el nombre *update* estamos infiriendo una actualización a esa tabla.
- ```Schema::table()``` realiza modificaciones sobre la tabla especificada.

## Modelos
- Convencion de nombres en laravel, los modelos se nombran **PascalCase** en singular, preferiblemente en una sola palabra.
- ```php artisan make:model Note``` genera un archivo modelo *Note*.
- en la Clase *Note* podriamos tener el sigiente código ```protected $table = "notas";``` si no podemos respetar la convencion en los nombres de laravel de la tabla en la DB, donde definimos manualmente a que tabla en la DB debería apuntar nuestro modelo.
- ```protected $fillable = [];``` define los campos que pueden ser cumplimentados.
- ```protected $guarded = [];``` es lo opuesto a *fillable*.
- ```protected $casts = [];``` castear datos.
- ```protected $hidden = [];``` evita que se entreguen datos que no deben ser entregados cuando se hace una serializacion de contenido, por ejemplo cuando se realiza una API y se van a estar entregando elementos.

## Comandos combinados
- ```php make:model Author --migration``` genera el modelo *Author* y tambien genera la migración *XXXX_XX_XX_XXXXXX_create_authors_table* respetando la convencion de nombres.

## Vinculacion Ruta-Controlador-Vista
- ```php artisan make:controller UserController``` genera un controlador *UserController*, se respeta la convencion de **PascalCase** para nombrar a los controlladores.

## Consultas a modelos, paso de informacion y pintado

## Insersion de datos

## Eloquent
- ```$users =User::where('age', '>=', 18)->where('zip_code', 290909)->where()->where();``` caracteristica conocida del patron de diseño active record, la concatenacion en consultas.

## SQL Raw
- ```DB::``` La clase DB permite realizar consultas con SQL puro.

## Rutas con parametros
- ```Route::get('/product/{id}',[Controller::class, 'function'])->name('example');``` Este es un ejemplo de una ruta con un parametro dinamico *id* obligatorio.
- ```Route::get('/product/{id?}',[Controller::class, 'function'])->name('example');``` Este es un ejemplo de una ruta con un parametro dinamico *id* opcional.
- Se debe tener cuidado con el manejo de parametros dinamicos en las rutas y el orden de las rutas, porque podrian haber rutas que nunca se ejecuten (colision de rutas).

## CRUD
- **C**:create; **R**:read, **U**:update, **D**:delete.

## Validacion y custom request
- ```php artisan make:request NoteRequest``` Crea una custom request, evitamos duplicacion de codigo en controlador.

## Gestion de errores y mensajes de sesion
- Directiva ```@error('')``` en la vista blade para los mensajes de error.
- Mensajes de sesion se pueden inplementar con un **_partials/messages.blade.php** con la clase Sessions ```$message = Session::get('success')```, se realiza un **@include()** ```@include('layouts._partials.messages')```.

## Rutas y controladores resource
- Se puede simplificar mas el proceso de creacion de un CRUD.
- La ruta **resource** define rutas para cada una de las acciones del CRUD ```Route::resource('/post', PostController::class);``` index, store, create, show, update, destroy, edit. 
- El comando para listar las rutas de la aplicacion es ```php artisan route:list```
- El comando para generar un controlador que gobierna un recurso ```php artisan make:controller PostController --resource```

## API
- ```php artisan make:model NameModel --migration``` genera un modelo ```NameModel``` con su respectiva migración.
- ```php artisan make:controller NoteController --resource``` genera un controlador con las acciones CRUD para el ejemplo.