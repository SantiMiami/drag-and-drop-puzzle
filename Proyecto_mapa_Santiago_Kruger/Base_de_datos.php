<?php
$servername = "localhost"; // Cambia esto al servidor de tu base de datos
$username = "root"; // Cambia esto a tu nombre de usuario de MySQL
$password = ""; // Cambia esto a tu contraseña de MySQL
$database = "MAPA EEUU"; // Cambia esto a tu nombre de base de datos
// Crea la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);
// Verifica la conexión
if ($conn->connect_error) {
 die("Error de conexión a la base de datos: ".$conn->connect_error);
}

/*
$sql = "CREATE TABLE estados (
        id INT AUTO_INCREMENT PRIMARY KEY,
        Washington VARCHAR(255) NOT NULL,
        Oregon VARCHAR(255) NOT NULL,
        California VARCHAR(255) NOT NULL,
        Nevada VARCHAR(255) NOT NULL,
        Idaho VARCHAR(255) NOT NULL,
        Montana VARCHAR(255) NOT NULL,
        Wyoming VARCHAR(255) NOT NULL,
        Colorado VARCHAR(255) NOT NULL,
        Utah VARCHAR(255) NOT NULL,
        Arizona VARCHAR(255) NOT NULL,
        Nuevo Mexico VARCHAR(255) NOT NULL,
        Oklahona VARCHAR(255) NOT NULL,
        Kansas VARCHAR(255) NOT NULL,
        Nebraska VARCHAR(255) NOT NULL,
        Dakota del sur VARCHAR(255) NOT NULL,
        Dakota del norte VARCHAR(255) NOT NULL,
        Minnesota VARCHAR(255) NOT NULL,
        Iowa VARCHAR(255) NOT NULL,
        Misuri VARCHAR(255) NOT NULL,
        Arkansas VARCHAR(255) NOT NULL,
        Luisiana VARCHAR(255) NOT NULL,
        Misisipi VARCHAR(255) NOT NULL,
        Alabama VARCHAR(255) NOT NULL,
        Georgia VARCHAR(255) NOT NULL,
        Florida VARCHAR(255) NOT NULL,
        Carolina del sur VARCHAR(255) NOT NULL,
        Carolina del norte VARCHAR(255) NOT NULL,
        Maryland VARCHAR(255) NOT NULL,
        Tennessee VARCHAR(255) NOT NULL,
        Kentucky VARCHAR(255) NOT NULL,
        Ohio VARCHAR(255) NOT NULL,
        Virgina occidental VARCHAR(255) NOT NULL,
        Indiana VARCHAR(255) NOT NULL,
        Michigan VARCHAR(255) NOT NULL,
        Wisconsis VARCHAR(255) NOT NULL,
        Illinois VARCHAR(255) NOT NULL,
        Pensilvania VARCHAR(255) NOT NULL,
        New york VARCHAR(255) NOT NULL,
        New jersey VARCHAR(255) NOT NULL,
        Delaware VARCHAR(255) NOT NULL,
        Maryland VARCHAR(255) NOT NULL,
        Virgina VARCHAR(255) NOT NULL,
        Vermont VARCHAR(255) NOT NULL,
        New hampshire VARCHAR(255) NOT NULL,
        Maine VARCHAR(255) NOT NULL,
        Massachusetts VARCHAR(255) NOT NULL,
        Connecticut VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) == TRUE){
    echo 'Las taablas se crearon';
}else{
    echo 'NO';
}
/*




//////////////////////////////////////////////////////////////////////////////////////////////
//-- Crear tabla de Clases
$sql = "CREATE TABLE NOMBRE DEL PROMOCION (
    Codigo INT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,

);";
if ($conn->query($sql) == TRUE){
    echo 'Las taablas se crearon';
}else{
    echo 'Gei';
}
//-- Crear tabla de Maestros
$sql = "CREATE TABLE CANTIDAD (
    Id INT PRIMARY KEY,
    Nombre VARCHAR(255) NOT NULL,
    Apellido VARCHAR(255) NOT NULL
);";
if ($conn->query($sql) == TRUE){
    echo 'Las taablas se crearon';
}else{
    echo 'Gei';
}
//-- Crear tabla de Estudiantes
$sql = "CREATE TABLE COSTO (
    CLAVE DE USUARIO INT PRIMARY KEY,
    CLAVE DE PROTOCOLO VARCHAR(255) NOT NULL,
    CANTIDAD INT NOT NULL,
    COSTO DE PRODUCTO DATE NOT NULL,
    MARCA INT,
);";
if ($conn->query($sql) == TRUE){
    echo 'Las taablas se crearon';
}else{
    echo 'Gei';
}
//-- Crear tabla de Secciones
$sql = "CREATE TABLE MARCA (
    CLAVE DE USUARIO INT PRIMARY KEY,
    NOMBRE DEL PROMOCIONADOR VARCHAR(255),
    CANTIDAD INT,
    COSTO DEL PRODUCTO REAL NOT NULL,
    MARCA VARCHAR(255) NOT NULL,
);";

$sql = "INSERT INTO estudiantes (Id, Nombre, Apellido, Fecha_de_nacimiento) VALUES ('1', 'Santiago', 'Krüger', '2005-10-06');";
*/





?>