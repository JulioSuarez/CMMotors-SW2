document.getElementById("exportButton").addEventListener("click",function(o){var t=document.getElementById("loadingScreen");console.log("hola mundo"),t.style.display="flex",this.classList.add("disabled"),this.disabled=!0,this.style.backgroundColor="gray",fetch("/exportar/producto/view").then(e=>{console.log("hola xD"),e.ok&&(t.style.display="none",document.getElementById("exportButton").classList.remove("disabled"),document.getElementById("exportButton").disabled=!1,document.getElementById("exportButton").style.backgroundColor="")}).catch(e=>{console.error(e)}),o.preventDefault()});
