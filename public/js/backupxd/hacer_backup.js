const fs = require('fs');

const guardarDB = () => {
    console.log('se ejecuto correctamente')
    //direccion de donde se guardara!!
    const archivo = './bd/data.txt'
    fs.writeFileSync(archivo,'Hola mundo!!!')
}

guardarDB();



