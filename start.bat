@echo off
REM

REM
php -v >nul 2>&1
IF ERRORLEVEL 1 (
    echo PHP no está instalado o no está configurado en la variable de entorno PATH.
    pause
    exit /b
)

REM
php -S localhost:8080 -t public/

REM
echo Presiona una tecla para cerrar...
pause
