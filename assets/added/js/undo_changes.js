window.addEventListener("load", function() {
    var etiquetas = document.querySelectorAll("[data-backup]");
  
    for (var i = 0; i < etiquetas.length; i++) {
      etiquetas[i].addEventListener("click", function(event) {
        console.log(event);
        event.preventDefault();
  
        var link = event.target; // Obtenemos el elemento en el que se hizo clic
        var data_options = link.getAttribute("data-options");
        link.removeAttribute("data-options");
        var options = JSON.parse(data_options);
        console.log(options);

        var form = document.createElement("form");
        form.setAttribute("method", "POST");
        form.setAttribute("action", "index.php");

        options.forEach(element => {
            let input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", element[0]);
            input.setAttribute("value", element[1]);
            form.appendChild(input);
        });

        // Envía el formulario
        document.body.appendChild(form);
        form.submit();
      });
    }
  });