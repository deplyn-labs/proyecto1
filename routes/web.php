<?php

//VISTAS
Route::get("/", ControladorUsuarios::class);
Route::get("/listar_usuarios", ControladorUsuarios::class);
Route::get("/usuarios/form/crear", ControladorUsuarios::class."@formCrearUsuario");
Route::get("/usuarios/form/edicion/:id", ControladorUsuarios::class."@formEdicionUsuario");

//RECURSOS
Route::post("/usuarios/registrar", ControladorUsuarios::class."@insertarUsuario");
Route::post("/usuarios/actualizar", ControladorUsuarios::class."@actualizarUsuario");
Route::post("/usuarios/consultarUsuarioPorId", ControladorUsuarios::class."@buscarUsuarioPorId");
Route::post("/usuarios/eliminarUsuarioPorId", ControladorUsuarios::class."@eliminarUsuarioPorId");