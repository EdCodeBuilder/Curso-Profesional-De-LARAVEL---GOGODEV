# Notas de curso de Laravel
***
## Tabla de contenido
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

## Instalación
```pyhton
a = 2
b = 3 + a
print(b)
print("Esto es un bloque de codigo python!")
```
## Uso
## Tecnologías ocupadas
## Licencias