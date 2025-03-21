<script>
$(document).ready(function() {
    $('#uploadForm').on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de manera tradicional

        var fileInput = $('#file')[0].files[0];
        if (fileInput) {
            var allowedTypes = ['application/pdf', 'image/jpeg'];
            if ($.inArray(fileInput.type, allowedTypes) === -1) {
                $('#message').text("Solo se permiten archivos PDF, JPG o JPEG.");
                return;
            }

            var formData = new FormData();
            formData.append('file', fileInput);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#message').text(response);
                },
                error: function() {
                    $('#message').text("Hubo un error al subir el archivo.");
                }
            });
        } else {
            $('#message').text("Por favor, selecciona un archivo.");
        }
    });
});
</script>
