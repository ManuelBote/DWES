<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>
 
    <form action="ej14_Tratamiento.php" method="get">
        <fieldset>

            <legend>Datos Personales</legend>

            <div>
                <label>Nombre</label>
                <br/>
                <input type="text" name="nombre">
            </div>
            <br/>
            <div>
                <label>Apellido</label>
                <br/>
                <input type="text" name="apellido">
            </div>
            <br/>
            <div>
                <label>Contraseña</label>
                <br/>
                <input type="password" name="ps">
            </div>
            <br/>
            <div>
                <label>Sexo</label>
                <br/>
                <input type="radio" name="sexo" checked="checke" value="H">Hombre
                <input type="radio" name="sexo" value="M">Mujer
            </div>
            <br/>
            <div>
                <label>Fecha nacimiento</label>
                <br/>
                <input type="date" name="fechaN">
            </div>
            <br/>
            <div>
                <label>País</label>
                <br />
                <select name="pais[]" multiple="multiple">
                    <option selected="selected">España</option>
                    <option>Portugal</option>
                    <option>EEUU</option>
                </select>
            </div>
        </fieldset>

        <fieldset>
            <legend>Informacion adicional</legend>
            <div>
                <label>Nº de hijos</label>
                <br/>
                <select name="nHihos">
                    <option>0</option>
                    <option>1</option>
                    <option selected="selected">2</option>
                    <option>3</option>
                    <option>4 o mas</option>
                </select>
            </div>
            <br/>
            <div>
                <label>Sube tu foto</label>
                <br/>
                <input type="file" name="foto"/>
            </div>
            <br/>
            <div>
                <label>Aficciones</label>
                <br/>
                <input type="checkbox" name="aficc[]" value="Cine"/>Cine
                <input type="checkbox" name="aficc[]" value="Deporte"/>Deporte
                <input type="checkbox" name="aficc[]" value="Literatura"/>Literatura
            </div>
            <br/>
            <div>
                <label>Comentario</label>
                <br/>
                <textarea placeholder="Escribe mas sobre ti" name="Comentario"></textarea>
            </div>
        </fieldset>

        <input type="submit" name="validar" value="Validar">
        <input type="submit" name="enviar" value="Enviar"> 

    </form>
    
</body>
</html>