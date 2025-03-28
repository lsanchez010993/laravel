document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector('.search-bar input[name="nombre_comun"]');
    const resultados = document.querySelector('#resultat'); 

    let timeout = null;
    let currentQuery = ''; // variable para almacenar la última búsqueda

    input.addEventListener('input', function () {
        const query = input.value.trim();

        // Guardar este query como el "query actual"
        currentQuery = query;

        // Limpiar resultados si no hay texto
        if (!query) {
            resultados.innerHTML = '';
        }

        // Cancelar solicitudes previas si el usuario sigue escribiendo
        if (timeout) clearTimeout(timeout);

        timeout = setTimeout(() => {
            // Si en este punto el usuario ya borró el input, salimos
            if (!currentQuery) {
                resultados.innerHTML = '';
                return;
            }

            fetch(`/buscar/animal?nombre_comun=${encodeURIComponent(currentQuery)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta de la red');
                    }
                    return response.text(); // Se espera HTML
                })
                .then(html => {
                    // Verificar si el query no ha cambiado mientras llegaba la respuesta
                    if (currentQuery === input.value.trim()) {
                        resultados.innerHTML = html; 
                    }
                })
                .catch(error => {
                    resultados.innerHTML = '<p>Ocurrió un error al realizar la búsqueda</p>';
                    console.error(error);
                });
        }, 300); 
    });
});
