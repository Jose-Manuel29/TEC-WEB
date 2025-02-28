document.getElementById("formularioProducto").addEventListener("submit", function(event) {
    let isValid = true;

    // Validar Nombre
    const name = document.getElementById("form-name").value.trim();
    if (name === "" || name.length > 100) {
        alert("El nombre es requerido y debe tener 100 caracteres o menos.");
        isValid = false;
    }

    // Validar Marca (Lista de opciones predefinidas)
    const marca = document.getElementById("form-marca").value;
    const marcasValidas = ["Boss", "Dandy_Hats", "Barbas_Hats", "LV", "Balenciaga", "31_hats"];
    if (!marcasValidas.includes(marca)) {
        alert("Debe seleccionar una marca válida.");
        isValid = false;
    }

    // Validar Modelo (Debe contener al menos una letra y un número, máximo 25 caracteres)
    const modelo = document.getElementById("form-modelo").value.trim();
    if (!/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]+$/.test(modelo) || modelo.length > 25) {
        alert("El modelo es requerido, debe ser alfanumérico (contener al menos una letra y un número) y tener 25 caracteres o menos.");
        isValid = false;
    }

    // Validar Precio (Mayor a 99.99)
    const precio = parseFloat(document.getElementById("form-precio").value);
    if (isNaN(precio) || precio <= 99.99) {
        alert("El precio es requerido y debe ser mayor a 99.99.");
        isValid = false;
    }

    // Validar Detalles (Opcional, máximo 250 caracteres)
    const detalles = document.getElementById("form-detalles").value.trim();
    if (detalles.length > 250) {
        alert("Los detalles deben tener 250 caracteres o menos.");
        isValid = false;
    }

    // Validar Unidades (Número mayor o igual a 10)
    const unidades = parseFloat(document.getElementById("form-unidades").value);
    if (isNaN(unidades) || unidades < 10) {
        alert("Las unidades deben ser un número mayor o igual a 10.");
        isValid = false;
    }

    // Validar Imagen (Mostrar mensaje en lugar de asignar un valor)
    const imagenInput = document.getElementById("form-image");
    if (imagenInput.files.length === 0) {
        alert("No se ha seleccionado una imagen. Se usará la imagen por defecto en el sistema.");
    }

    if (!isValid) {
        event.preventDefault(); // Evitar envío del formulario si hay errores
    }
});
