window.addEventListener("load", function() {
    var etiquetas = document.querySelectorAll("[data-function]");
  
    for (var i = 0; i < etiquetas.length; i++) {
      etiquetas[i].addEventListener("click", function(event) {
        console.log(event);
        event.preventDefault();
  
        var link = event.target; // Obtenemos el elemento en el que se hizo clic
        
        var options = JSON.parse(link.getAttribute("data-options"));
        console.log(options);
        console.log(options[1]);

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