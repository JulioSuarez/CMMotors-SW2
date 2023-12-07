export class search {
    constructor(myurlp, mysearchp, ul_add_lip) {
        this.url = myurlp;
        this.mysearchp = mysearchp;
        this.ul_add_li = ul_add_lip;
        this.idli = "mylist";
        this.pcantidad = document.querySelector("#pcantidad");
    }

    InputSearch() {
        this.mysearchp.addEventListener("input", (e) => {
            e.preventDefault();
            try {
                let token = document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content");
                let minimo_letras = 0;
                let valor = this.mysearchp.value;
                //Julico
                if (valor.length == 1) {
                    this.ul_add_li.innerHTML = "";
                    this.ul_add_li.innerHTML += `
                    <p style="color:green;"><br>Gracias por Buscar con CM Motos</p>
                    `;
                } else {
                    if (valor.length > minimo_letras) {
                        let datasearch = new FormData();
                        datasearch.append("valor", valor);
                        fetch(this.url, {
                            headers: {
                                "X-CSRF-TOKEN": token,
                            },
                            method: "post",
                            body: datasearch,
                        })
                            .then((data) => data.json())
                            .then((data) => {
                                // console.log("data")
                                this.ShowList(data, valor);
                            })
                            .catch(function (error) {
                                console.error("Error: ", error);
                            });
                        // }
                    } else {
                        this.ul_add_li.style.display = "";
                    }
                }
            } catch (error) {
                console.log(error);
            }
        });
    }

    ShowList(data, valor) {
        this.ul_add_li.style.display = "block";
        if (data.estado == 1) {
            if (data.result != "") {
                let arrayp = data.result;
                this.ul_add_li.innerHTML = "";
                let n = 0;
                this.show_list_each_data(arrayp, valor, n);
                let adclasli = document.getElementById("1" + this.idli);
                adclasli.classList.add("selected");
            } else {
                this.ul_add_li.innerHTML = "";
                this.ul_add_li.innerHTML += `
                <p style="color:red;"><br>No se encontro el codigo</p>
                `;
            }
        }
    }

    show_list_each_data(arrayp, valor, n) {
        for (let item of arrayp) {
            n++;
            let nombre = item.id;
            this.ul_add_li.innerHTML += `

            <div id="${n + this.idli}" value="${item.id}"
            class="list-group-item my-8 mx-8 overflow-hidden rounded-lg shadow-xs"> <!-- reemplace w-full por mx-8 -->
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b
                         dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">cod OEM</th>
                            <th class="px-4 py-3">Productos</th>
                            <th class="px-4 py-3">Precio</th>
                            <th class="px-4 py-3">Detalles</th>
                        </tr>
                    </thead>
                    <tbody class=" bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                    <tr
                    class=" bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-sm">${n} - ${item.cod_oem}</td>
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="object-cover w-full h-full rounded-full"
                                    src="https://galba.com.bo/wp-content/uploads/2022/07/CF0001.jpg"
                                    alt="" loading="lazy" />
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                </div>
                            </div>
                            <div>
                                <p class="font-semibold">${item.nombre}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">${
                                    item.descripcion
                                }
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-sm">${item.precio1}</td>
                    <td> <a href="/Producto/${item.id}/edit">Click</a></td>
                </tr>
        </tbody>
    </table>
</div>
</div>
            `;
        }
    }
}

/*


            <li id="${n + this.idli}" value="${
                item.nombre
            }" class="list-group-item" style="">
            <div class="d-flex flex-row" style="">
            <div class="p-2 text-center divimg" style="">
            <img src="/img/${
                item.foto
            }" class="img-thumbnail" width="50" height="50" alt="Imagen xD">
            </div>
            <div class="p-2">
                <strong>${nombre}</strong>
                <p class="card-text">P. Venta $ : ${item.precio1}</p>

            </div>
            </div>
            </li>
*/
