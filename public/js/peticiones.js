document.getElementById("campo").addEventListener("keyup", getCodigos);

console.log("Hola mundo!!!!");

function getCodigos() {
    let inputCi = document.getElementById("campo").value;   //input de buscar
    let lista = document.getElementById("lista");           //ul lista de despliegue
    console.log("complete inputci y lista");
    // if (inputCi.length > 0) {
    // console.log("entre a la condicional");

    let url = "inc/getCodigos.php";
    // console.log("entre a inc getCodigos.php");
    let formData = new FormData();
    formData.append("campo", inputCi);
    // console.log("xd1");

    fetch(url, {
        method: "POST",
        body: formData,
        mode: "cors", //Default cors, no-cors, same-origin
    })
        .then((response) => response.json())
        .then((data) => {
            lista.style.display = "block";
            lista.innerHTML = data;
        })
        .catch((err) => console.log(err));
    // } else {
    // lista.style.display = 'none'
    // }
}

// function mostrar(ci) {
//     lista.style.display = 'none'
//     alert("ci: " + $ci)
// }
