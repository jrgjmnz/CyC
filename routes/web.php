<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('auth/login');
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Backend')->prefix('backend')->group(function () {
    Route::get('/login', 'LoginController@getLogin')->name('backend.login.form');
    Route::post('/login', 'LoginController@postLogin')->name('backend.login.post');
    Route::get('/logout', 'LoginController@logout')->name('backend.logout');
});
//get('/rutaControllador', 'monedasController@index')->name('nombrePersonalizado'); 

Route::namespace('Backend')->prefix('backend')->group(function () {
    
    //ruta contactos 
    Route::get('/contactos/{proveedor_id}', 'contactosController@index')->name('contactos.index');
    Route::get('/contactos/{proveedor_id}/new', 'contactosController@form')->name('contactos.new');
    Route::get('/contactos/{contacto}/{proveedor_id}/edit', 'contactosController@form')->name('contactos.form');
    Route::post('/contactos/{proveedor_id}/save', 'contactosController@post')->name('contactos.save');
    Route::post('/contactos/{contacto}/delete', 'contactosController@delete')->name('contactos.delete');
    Route::post('/contactos/{contacto}/restore', 'contactosController@restore')->name('contactos.restore');
    Route::post('/contactos/{contacto}/force-delete', 'contactosController@forceDelete')->name('contactos.force-delete');

    //rutas orden de compra 
    Route::get('/ordenCompra/export/', 'ordenCompraController@export')->name('ordenCompra.export');

    Route::get('/ordenCompra', 'ordenCompraController@index')->name('ordenCompra.index');
    Route::get('/ordenCompra/new', 'ordenCompraController@form')->name('ordenCompra.form');
    //Route::get('/ordenCompra/{ordenCompra}/edit', 'ordenCompraController@form')->name('ordenCompra.form');
    Route::post('/ordenCompra/save', 'ordenCompraController@post')->name('ordenCompra.save');
    Route::post('/ordenCompra/{ordenCompra}/delete', 'ordenCompraController@delete')->name('ordenCompra.delete');
    Route::post('/ordenCompra/{ordenCompra}/restore', 'ordenCompraController@restore')->name('ordenCompra.restore');
    Route::post('/ordenCompra/{ordenCompra}/force-delete', 'ordenCompraController@forceDelete')->name('ordenCompra.force-delete');

    //Rutas Liciaciones
    Route::get('/licitaciones', 'licitacionesController@index')->name('licitaciones.index');
    Route::get('/licitaciones/new', 'licitacionesController@form')->name('licitaciones.form');
    Route::post('/licitaciones/save', 'licitacionesController@post')->name('licitaciones.save');
    Route::post('/licitaciones/{licitaciones}/delete', 'licitacionesController@delete')->name('licitaciones.delete');
    Route::post('/licitaciones/{licitaciones}/restore', 'licitacionesController@restore')->name('licitaciones.restore');
    Route::post('/licitaciones/{licitaciones}/delete', 'licitacionesController@forceDelete')->name('licitaciones.force-delete');


    //rutas users
    Route::get('users', 'registroController@index')->name('users.index');
    Route::get('/users/new', 'registroController@form')->name('users.new');
    Route::get('/users/{users}/edit', 'registroController@form')->name('users.form');
    Route::post('/users/save', 'registroController@post')->name('users.save');
    Route::post('/users/{users}/delete', 'registroController@delete')->name('users.delete');
    Route::post('/users/{users}/restore', 'registroController@restore')->name('users.restore');
    Route::post('/users/{users}/force-delete', 'registroController@forceDelete')->name('users.force-delete');

    //Rutas Monedas
    Route::get('/monedas', 'monedasController@index')->name('monedas.index');
    Route::get('/monedas/new', 'monedasController@form')->name('monedas.new');
    Route::get('/monedas/{moneda}/edit', 'monedasController@form')->name('monedas.form');
    Route::post('/monedas/save', 'monedasController@post')->name('monedas.save');
    Route::post('/monedas/{moneda}/delete', 'monedasController@delete')->name('monedas.delete');
    Route::post('/monedas/{moneda}/restore', 'monedasController@restore')->name('monedas.restore');
    Route::post('/monedas/{moneda}/force-delete', 'monedasController@forceDelete')->name('monedas.force-delete');
    
    //Rutas Cargos
    Route::get('cargos', 'cargosController@index')->name('cargos.index');
    Route::get('/cargos/new', 'cargosController@form')->name('cargos.new');
    Route::get('/cargos/{cargo}/edit', 'cargosController@form')->name('cargos.form');
    Route::post('/cargos/save', 'cargosController@post')->name('cargos.save');
    Route::post('/cargos/{cargo}/delete', 'cargosController@delete')->name('cargos.delete');
    Route::post('/cargos/{cargo}/restore', 'cargosController@restore')->name('cargos.restore');
    Route::post('/cargos/{cargo}/force-delete', 'cargosController@forceDelete')->name('cargos.force-delete');
    
    //Rutas Proveedor
    Route::get('/proveedores', 'proveedoresController@index')->name('proveedores.index');
    Route::get('/proveedores/new', 'proveedoresController@form')->name('proveedores.new');
    Route::get('/proveedores/{proveedor}/edit', 'proveedoresController@form')->name('proveedores.form');
    Route::post('/proveedores/save', 'proveedoresController@post')->name('proveedores.save');
    Route::post('/proveedores/{proveedor}/delete', 'proveedoresController@delete')->name('proveedores.delete');
    Route::post('/proveedores/{proveedor}/restore', 'proveedoresController@restore')->name('proveedores.restore');
    Route::post('/proveedores/{proveedor}/force-delete', 'proveedoresController@forceDelete')->name('proveedores.force-delete');
    
    //Rutas Prestación
    Route::get('/prestaciones', 'prestacionesController@index')->name('prestaciones.index');
    Route::get('/prestaciones/new', 'prestacionesController@form')->name('prestaciones.new');
    Route::get('/prestaciones/{prestacion}/edit', 'prestacionesController@form')->name('prestaciones.form');
    Route::post('/prestaciones/save', 'prestacionesController@post')->name('prestaciones.save');
    Route::post('/prestaciones/{prestacion}/delete', 'prestacionesController@delete')->name('prestaciones.delete');
    Route::post('/prestaciones/{prestacion}/restore', 'prestacionesController@restore')->name('prestaciones.restore');
    Route::post('/prestaciones/{prestacion}/force-delete', 'prestacionesController@forceDelete')->name('prestaciones.force-delete');
    
    //Rutas Boleta
    Route::get('/boletas', 'boletasController@index')->name('boletas.index');
    Route::get('/boletas/new', 'boletasController@form')->name('boletas.new');
    Route::get('/boletas/{boleta}/edit', 'boletasController@form')->name('boletas.form');
    Route::post('/boletas/save', 'boletasController@post')->name('boletas.save');
    Route::post('/boletas/{boleta}/delete', 'boletasController@delete')->name('boletas.delete');
    Route::post('/boletas/{boleta}/restore', 'boletasController@restore')->name('boletas.restore');
    Route::post('/boletas/{boleta}/force-delete', 'boletasController@forceDelete')->name('boletas.force-delete');
    
    //Rutas Convenios
    Route::get('/convenios/export/', 'conveniosController@export')->name('convenios.export');
    
    Route::get('/convenios', 'conveniosController@index')->name('convenios.index');
    Route::get('/convenios/new', 'conveniosController@form')->name('convenios.new');
    Route::get('/convenios/{convenio}/edit', 'conveniosController@form')->name('convenios.form');
    Route::post('/convenios/save', 'conveniosController@post')->name('convenios.save');
    Route::post('/convenios/{convenio}/delete', 'conveniosController@delete')->name('convenios.delete');
    Route::post('/convenios/{convenio}/restore', 'conveniosController@restore')->name('convenios.restore');
    Route::post('/convenios/{convenio}/force-delete', 'conveniosController@forceDelete')->name('convenios.force-delete');

    //ruta bitacoraConvenio
    Route::get('/bitacoraConvenio/{convenio_id}', 'evolucionConveniosController@index')->name('bitacoraConvenio.index');
    Route::get('/bitacoraConvenio/{convenio_id}/new', 'evolucionConveniosController@form')->name('bitacoraConvenio.new');
    Route::post('/bitacoraConvenio/{convenio_id}/save', 'evolucionConveniosController@post')->name('bitacoraConvenio.save');

    //convenioPrestaciones;
    Route::get('/convenioPrestaciones/{convenio_id}', 'convenioPrestacionesController@index')->name('convenioPrestaciones.index');
    Route::get('/convenioPrestaciones/{convenio_id}/{prestacion_id}/new', 'convenioPrestacionesController@form')->name('convenioPrestaciones.new');
    Route::get('/convenioPrestaciones/{cPrestacion}/edit/{convenio_id}/{prestacion_id}', 'convenioPrestacionesController@form')->name('convenioPrestaciones.form');
    Route::post('/convenioPrestaciones/{convenio_id}/{prestacion_id}/save', 'convenioPrestacionesController@post')->name('convenioPrestaciones.save');
    Route::post('/convenioPrestaciones/{cPrestacion}/delete', 'convenioPrestacionesController@delete')->name('convenioPrestaciones.delete');
    Route::post('/convenioPrestaciones/{cPrestacion}/restore', 'convenioPrestacionesController@restore')->name('convenioPrestaciones.restore');
    Route::post('/convenioPrestaciones/{cPrestacion}/force-delete', 'convenioPrestacionesController@forceDelete')->name('convenioPrestaciones.force-delete');

    //seleccionarPrestacion
    Route::get('/seleccionarPrestaciones/{convenio_id}', 'seleccionarPrestacionesController@index')->name('seleccionarPrestaciones.index');

    //Rutas Contratos
    Route::get('/contratos/export/', 'contratosController@export')->name('contratos.export');
    
    Route::get('/contratos', 'contratosController@index')->name('contratos.index');
    Route::get('/contratos/new', 'contratosController@form')->name('contratos.new');
    Route::get('/contratos/{contrato}/edit', 'contratosController@form')->name('contratos.form');
    Route::post('/contratos/save', 'contratosController@post')->name('contratos.save');
    Route::post('/contratos/{contrato}/delete', 'contratosController@delete')->name('contratos.delete');
    Route::post('/contratos/{contrato}/restore', 'contratosController@restore')->name('contratos.restore');
    Route::post('/contratos/{contrato}/force-delete', 'contratosController@forceDelete')->name('contratos.force-delete');

    //Route::get('/contratos', 'conratosController@store')->name('licitacion.store');
    

    //ruta bitacoraContrato
    Route::get('/bitacoraContrato/{contrato_id}', 'evolucionContratosController@index')->name('bitacoraContrato.index');
    Route::get('/bitacoraContrato/{contrato_id}/new', 'evolucionContratosController@form')->name('bitacoraContrato.new');
    Route::post('/bitacoraContrato/{contrato_id}/save', 'evolucionContratosController@post')->name('bitacoraContrato.save');

    //Rutas Alertas contrato
    Route::get('/alertaContrato', 'alertaContratoController@index')->name('alertaContrato.index');
    Route::get('/alertaContrato/new', 'alertaContratoController@form')->name('alertaContrato.new');
    Route::get('/alertaContrato/{alerta}/edit', 'alertaContratoController@form')->name('alertaContrato.form');
    Route::post('/alertaContrato/save', 'alertaContratoController@post')->name('alertaContrato.save');
    Route::post('/alertaContrato/{alerta}/delete', 'alertaContratoController@delete')->name('alertaContrato.delete');
    Route::post('/alertaContrato/{alerta}/restore', 'alertaContratoController@restore')->name('alertaContrato.restore');
    Route::post('/alertaContrato/{alerta}/force-delete', 'alertaContratoController@forceDelete')->name('alertaContrato.force-delete');
    Route::post('/alertaContrato/{contrato}/resolverContrato', 'alertaContratoController@resolverContrato')->name('alertaContrato.resolverContrato');
    Route::post('/alertaContrato/{contrato}/resolverBoletaContrato', 'alertaContratoController@resolverBoletaContrato')->name('alertaContrato.resolverBoletaContrato');
    Route::get('/alertaContrato/mostrar', 'alertaContratoController@mostrarTodos')->name('alertaContrato.mostrarTodos');
    Route::post('/alertaContrato/{contrato}/recuperarContrato', 'alertaContratoController@recuperarContrato')->name('alertaContrato.recuperarContrato');
    Route::post('/alertaContrato/{contrato}/recuperarBoletaContrato', 'alertaContratoController@recuperarBoletaContrato')->name('alertaContrato.recuperarBoletaContrato');

    //Rutas Alertas convenio
    Route::get('/alertaConvenio', 'alertaConvenioController@index')->name('alertaConvenio.index');
    Route::get('/alertaConvenio/new', 'alertaConvenioController@form')->name('alertaConvenio.new');
    Route::get('/alertaConvenio/{alerta}/edit', 'alertaConvenioController@form')->name('alertaConvenio.form');
    Route::post('/alertaConvenio/save', 'alertaConvenioController@post')->name('alertaConvenio.save');
    Route::post('/alertaConvenio/{alerta}/delete', 'alertaConvenioController@delete')->name('alertaConvenio.delete');
    Route::post('/alertaConvenio/{alerta}/restore', 'alertaConvenioController@restore')->name('alertaConvenio.restore');
    Route::post('/alertaConvenio/{alerta}/force-delete', 'alertaConvenioController@forceDelete')->name('alertaConvenio.force-delete');
    Route::post('/alertaConvenio/{convenio}/resolverConvenio', 'alertaConvenioController@resolverConvenio')->name('alertaConvenio.resolverConvenio');
    Route::post('/alertaConvenio/{convenio}/resolverBoletaConvenio', 'alertaConvenioController@resolverBoletaConvenio')->name('alertaConvenio.resolverBoletaConvenio');
    Route::get('/alertaConvenio/mostrar', 'alertaConvenioController@mostrarTodos')->name('alertaConvenio.mostrarTodos');
    Route::post('/alertaConvenio/{convenio}/recuperarConvenio', 'alertaConvenioController@recuperarConvenio')->name('alertaConvenio.recuperarConvenio');
    Route::post('/alertaConvenio/{convenio}/recuperarBoletaConvenio', 'alertaConvenioController@recuperarBoletaConvenio')->name('alertaConvenio.recuperarBoletaConvenio');

    //Rutas hitoContrato
    Route::get('/hitoContrato/{contrato}', 'hitoContratoController@index')->name('hitoContrato.index');
    Route::get('/hitoContrato/{contrato}/new', 'hitoContratoController@form')->name('hitoContrato.new');
    Route::get('/hitoContrato/{hito}/edit/{contrato}', 'hitoContratoController@form')->name('hitoContrato.form');
    Route::post('/hitoContrato/{contrato}/save', 'hitoContratoController@post')->name('hitoContrato.save');
    Route::post('/hitoContrato/{hito}/delete', 'hitoContratoController@delete')->name('hitoContrato.delete');
    Route::post('/hitoContrato/{hito}/restore', 'hitoContratoController@restore')->name('hitoContrato.restore');
    Route::post('/hitoContrato/{hito}/force-delete', 'hitoContratoController@forceDelete')->name('hitoContrato.force-delete');
    Route::post('/hitoContrato/{hito}/visto', 'hitoContratoController@visto')->name('hitoContrato.visto');
    Route::post('/hitoContrato/{hito}/recuperar', 'hitoContratoController@recuperar')->name('hitoContrato.recuperar');
    Route::get('/hitoContrato/{contrato}/mostrar', 'hitoContratoController@mostrarTodos')->name('hitoContrato.mostrarTodos');

    //Rutas hitoConvenio
    Route::get('/hitoConvenio/{convenio}', 'hitoConvenioController@index')->name('hitoConvenio.index');
    Route::get('/hitoConvenio/{convenio}/new', 'hitoConvenioController@form')->name('hitoConvenio.new');
    Route::get('/hitoConvenio/{hito}/edit/{convenio}', 'hitoConvenioController@form')->name('hitoConvenio.form');
    Route::post('/hitoConvenio/{convenio}/save', 'hitoConvenioController@post')->name('hitoConvenio.save');
    Route::post('/hitoConvenio/{hito}/delete', 'hitoConvenioController@delete')->name('hitoConvenio.delete');
    Route::post('/hitoConvenio/{hito}/restore', 'hitoConvenioController@restore')->name('hitoConvenio.restore');
    Route::post('/hitoConvenio/{hito}/force-delete', 'hitoConvenioController@forceDelete')->name('hitoConvenio.force-delete');
    Route::post('/hitoConvenio/{hito}/visto', 'hitoConvenioController@visto')->name('hitoConvenio.visto');
    Route::post('/hitoConvenio/{hito}/recuperar', 'hitoConvenioController@recuperar')->name('hitoConvenio.recuperar');
    Route::get('/hitoConvenio/{convenio}/mostrar', 'hitoConvenioController@mostrarTodos')->name('hitoConvenio.mostrarTodos');

    //Rutas Reportes
    Route::get('/creportes/export/', 'creportesController@export')->name('creportes.export');
    Route::get('/cvreportes/export/', 'cvreportesController@export')->name('cvreportes.export');

    Route::get('/creportes', 'creportesController@index')->name('creportes.index');
    Route::get('/cvreportes', 'cvreportesController@index')->name('cvreportes.index');

  
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
