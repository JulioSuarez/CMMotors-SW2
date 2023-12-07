/*
# By julico
# Archivo js que importa la clase principal para realizar la peticion al backend.
# este archivo traba de la mano con la funsion mostrar que esta en AuthController
*/
import {search} from './export_search.js';
// const searchproduct = new search();
// console.log(searchproduct.example());
const mysearchp = document.querySelector("#mysearch");
const ul_add_lip = document.querySelector("#ShowList");
const myurlp ="/myurl";
const searchproduct = new search(myurlp,mysearchp,ul_add_lip);
searchproduct.InputSearch();
