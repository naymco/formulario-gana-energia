<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <form method="post" action="registration.php" name="registro">
            <div class="form-element">
                <label>Nombre</label>
                <input type="text" name="nombre" pattern="[a-zA-Z0-9]+" required/>
            </div>
            <div class="form-element">
                <label>Apellidos</label>
                <input type="text" name="apellidos" required/>
            </div>
            <div class="form-element">
                <label>Dirección</label>
                <input type="text" name="direccion" required/>
            </div>
            <div class="form-element">
                <label>email</label>
                <input type="email" name="email" required/>
            </div>
            <div class="form-element">
                <label>Password</label>
                <input type="password" name="password" required/>
            </div>
            <div class="form-element">
                <label>Código postal</label>
                <input type="text" name="cod_postal" id="cod_postal" onchange="municipio()" required/>
                <p id="municipio-tiempo-real">  </p>
                <script>
                    let codPostal = document.getElementById('municipio-tiempo-real');
                    let muni = '';
                    const municipio = async () =>{
                        let value = document.getElementById("cod_postal").value;
                        const res = await fetch(`https://webservicetest.gaolania.com.es/ine.json/id/${value}`);
                            mun = await res.json();

                        muni = mun[0].municipio;
                        console.log(muni);
                        codPostal.innerHTML = muni;
                    }
                </script>


            </div>
            <button type="submit" name="registrar" value="registrar">Registrar</button>
        </form>
    </body>
</html>