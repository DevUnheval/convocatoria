
function validar_peso_archivo(archivoActual){
    if(archivoActual.files[0].size>pesoMaxArchivo){
        console.log("El peso máximo es "+pesoMaxArchivo_MB);
        Swal.fire({
            type: 'warning',
            title: "¡Advertencia!",
            text: `El archivo seleccionado supera los ${pesoMaxArchivo_MB}MB en tamaño, seleccione otro archivo.`,
            timer: null
        })
        archivoActual.value = '';
        return false;
    }
}