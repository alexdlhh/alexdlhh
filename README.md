## Instalation

#levantar proyecto en local

localhost:8010

```
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app composer require laravel/passport --with-all-dependencies
```

#migrar bbdd

```
docker-compose exec app artisan migrate
```

`Hay que cambiar los id por int(11) y relanzar hasta acabar con todas las migraciones`

## Ubicación

Este proyecto se va a hubicar dentro de una subcarpeta de Wordpress


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


Tipos de productos:

Esquis: gama media-alta 30 esquis
             Gama media alta niños y adultos chicos 12 esquis
             Gama media alta niños 12 esquis
             Gama alta unisex  28 esquis
             Gama alta chica 11 esquis
             Gama vip 7 esquis
Este año hemos pedido mas esquis pero estos son los que hay ahora mismo en stock
Botas de esquis tallas: 15, 15,5, 16, 16,5, 17, 17,5, 18, 18,5, 19, 19,5, 20, 20,5, 21, 21,5,22,22,5,23, 23,5,24, 24,5, 25, 25,5,26,26,5, 27, 27,5, 28, 28,5, 29, 29,5, 30, 30,5,31, 31,5

Tablas de snow:  (Solo hay gama media alta)
1 de 90cm
1 de 100cm
2 de 110cm
2 de 120 cm
3 de 130 cm
3 de 140 cm
4 de 145 cm
4 de 150cm
4 de 155cm
3 de 160cm

Botas de snow tallas: 16,5, 17, 17,5, 18, 18,5, 19, 19,5, 20, 20,5, 21, 21,5,22,22,5,23, 23,5,24, 24,5, 25, 25,5,26,26,5, 27, 27,5, 28, 28,5, 29, 29,5, 30, 30,5,31, 31,5

Satisfacción del cliente, no lo se como podríamos hacerlo, nosotros normalmente si acaban contentos les hemos mandado enlace de reseñas en google siempre hablándolo en persona con ellos.

Datos del clientes nombre, apellidos, dni, dirección, teléfono movil, altura, numero de pie, peso, nivel de esquí o snow y pie delantero si es de snow.



2 Cursos, se impartiran cursos en fechas seleccionadas según el calendario de la estación en días puntuales de mucho aforo de la estación que tenemos que plantear una vez que salga el calendario nuevo de la temporada.

La duración podrá ser de 2 o 3 horas, si son de 2 horas se comenzara a las 10:00 o 12:00, si son de 3 horas el horario seria a las 9:00 o a las 12:00
El tope aqui seria de 6 máximo.


Las clases particulares la recomendación siempre es de 2 horas, los horarios serian de 10-12, de 12-14, de 14-16 y de 15-17 exceptuando algunos casos que podrían ser de 1 hora con los horarios de 9-10, 14-15, 15-16 y de 16-17 o de 3 horas de 9-12, 12-15 y de 14-17
Tambien hay casos que puedan contratar 4, 5 y 6 horas que se les podría vender en cualquier horario.
El máximo del grupo serian 8 personas.

Los datos de los profesores serian para poner su nombre, modalidad, idioma, disponibilidad y el teléfono seria siempre el de la escuela para no dar su teléfono personal, aquí no sabríamos los profesores disponibles ya que van variando según la temporada

Todavía no me contestaron los del banco con el tpv virtual ya que hable con ellos hace mas de un mes y no tengo respuesta.

Acabo de llegar de vacaciones y en estos dias iré al banco hablar. Personalmente para que me digan soluciones al tpv virtual, y pasare por el local que es donde tengo el inventario con todos los modelos de esquis y botas