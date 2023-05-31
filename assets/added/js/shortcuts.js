window.addEventListener("load", function() {
    document.addEventListener("keydown", function(event) {
        // Verifica si se presionó la tecla específica del atajo
        if (event.code === "KeyI") {
          let button = document.getElementById("Add");
          button.click();
        }

        if (event.code === "KeyZ") {
            let button = document.getElementById("Back");
            button.click();
          }
      });
      
});