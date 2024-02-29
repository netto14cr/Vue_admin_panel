
// ----------------------------------------------   EDITAR   ----------------------------------------------

    var updatedFields = []; // Almacena temporalmente los campos actualizados

    $(document).on('change', 'select[name^="colors"], select[name^="sizes"], input[name^="quantities"]', function() {
    var stockId = $(this).closest('.input-group').find('input[name^="stock_ids"]').val();


    console.log("Evento de cambio detectado. Stock ID actual:", stockId);

    if (stockId && updatedFields.indexOf(stockId) === -1) {
    // Obtener valores actualizados
    var colorId = $(this).closest('.input-group').find('select[name^="colors"]').val();
    var sizeId = $(this).closest('.input-group').find('select[name^="sizes"]').val();
    var quantity = $(this).closest('.input-group').find('input[name^="quantities"]').val();

    // Agregar los datos actualizados al array
    updatedFields.push({ stockId: stockId, colorId: colorId, sizeId: sizeId, quantity: quantity });
    console.log("Stock ID actualizado:", stockId);
    updateUpdatedFieldsInput();
}
});

    // Función para actualizar el campo oculto con la información de los campos actualizados
    function updateUpdatedFieldsInput() {
    var updatedFieldsInput = $('#updated_fields');
    updatedFieldsInput.val(JSON.stringify(updatedFields));
    console.log("Campos actualizados:", updatedFields);
}


// ----------------------------------------------   Eliminar   ----------------------------------------------
// Script para el formulario de hacer la parte de eliminar dinámica en el formulario de editar
    var deletedFields = []; // Almacena temporalmente los campos eliminados

    $(document).on('click', '[id^=remove_size_color_]', function() {


    var stockId = $(this).data('stockid');
    console.log("stockId:", stockId);

    if (stockId) {
    // Almacena la información sobre el campo eliminado
    deletedFields.push({ stockId: stockId });

    // Actualiza el campo oculto con la información de los campos eliminados
    updateDeletedFieldsInput();

    // Elimina visualmente el campo
    $(this).closest('.input-group').remove();

} else {
    // Si no hay un ID asociado, simplemente elimina visualmente
    $(this).closest('.input-group').remove();
}

    location.reload();
});

    // Función para agregar nuevos campos dinámicos
    $(document).on('click', '#add_field', function() {
    var template = $('.input-group:first').clone(); // Clonar el primer campo
    template.find('input').val(''); // Limpiar el valor del input
    template.appendTo('#dynamic_fields'); // Agregar el nuevo campo al contenedor
});

    // Función para actualizar el campo oculto con la información de los campos eliminados
    function updateDeletedFieldsInput() {
    var deletedFieldsInput = $('#deleted_fields');
    deletedFieldsInput.val(JSON.stringify(deletedFields));
}

// ----------------------------------------------   AÑADIR   ----------------------------------------------



    var updatedFieldsAdd = {}; // Almacena temporalmente los campos actualizados en el formulario de añadir

    // Script para el formulario de añadir
    $(document).on('change', 'select[name^="colors_add"], select[name^="sizes_add"], input[name^="quantities_add"]', function() {
    var stockIdAdd = $(this).closest('.input-group').find('input[name^="stock_ids_add"]').val();
    console.log("Evento de cambio detectado. Stock ID actual en el formulario de añadir:", stockIdAdd);

    if (stockIdAdd) {
    // Obtener valores actualizados en el formulario de añadir
    var colorIdAdd = $(this).closest('.input-group').find('select[name^="colors_add"]').val();
    var sizeIdAdd = $(this).closest('.input-group').find('select[name^="sizes_add"]').val();
    var quantityAdd = $(this).closest('.input-group').find('input[name^="quantities_add"]').val();
    console.log("Valores actualizados en el formulario de añadir:", colorIdAdd, sizeIdAdd, quantityAdd);

    // Actualizar el array en el formulario de añadir
    updatedFieldsAdd[stockIdAdd] = { stockId: stockIdAdd, colorId: colorIdAdd, sizeId: sizeIdAdd, quantity: quantityAdd };
    console.log("Stock ID actualizado en el formulario de añadir:", stockIdAdd);
    updateUpdatedFieldsAddInput();
}
});

    // Función para actualizar el campo oculto con la información de los campos actualizados en el formulario de añadir
    function updateUpdatedFieldsAddInput() {
    var updatedFieldsAddInput = $('#updated_fields_add');
    updatedFieldsAddInput.val(JSON.stringify(Object.values(updatedFieldsAdd)));
    console.log("Campos actualizados en el formulario de añadir:", Object.values(updatedFieldsAdd));

}

    // Mostrar el formulario de añadir al hacer clic en el botón correspondiente
    $(document).on('click', '#show_add_form', function() {
    $('#dynamic_fields_add').show();
    toggleRequiredAttribute(true); // Agrega el atributo required
    toggleFormSection(false); // oculta la sección del formulario
});

    // Ocultar el formulario de añadir al hacer clic en el botón correspondiente
    $(document).on('click', '#remove_size_color_add', function() {
    $('#dynamic_fields_add').find('select[name^="colors_add"], select[name^="sizes_add"], input[name^="quantities_add"]').val('');
    $('#dynamic_fields_add').hide();
    toggleRequiredAttribute(false); // Elimina el atributo required
    toggleFormSection(true); // Muestra la sección del formulario

    // Limpiar el array de campos actualizados en el formulario de añadir
    updatedFieldsAdd = {};
    updateUpdatedFieldsAddInput(); // Actualizar el campo oculto con el array limpio
});

    // Función para mostrar u ocultar la sección del formulario
    function toggleFormSection(showSection) {
    var formSection = $('#new_fields'); // Ajusta según el ID específico de la sección que deseas ocultar/mostrar

    if (showSection) {
    formSection.show();
} else {
    formSection.hide();
}
}

    // Función para agregar o eliminar el atributo required del campo de entrada
    function toggleRequiredAttribute(addRequired) {
    var quantitiesAddInput = $('input[name^="quantities_add[]"]');
    if (addRequired) {
    quantitiesAddInput.attr('required', 'required');
} else {
    quantitiesAddInput.removeAttr('required');
}
}

