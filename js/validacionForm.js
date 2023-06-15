'use strict'
console.log("a");
// Fetch all the forms we want to apply custom Bootstrap validation styles to
const forms = document.querySelectorAll('.needs-validation')

// Loop over them and prevent submission
Array.from(forms).forEach(form => {
  form.addEventListener('submit', event => {
    if (!form.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    }else{
        //var datos = $(forms).serialize();
        //$.ajax({ 
        //    type: "POST",
        //    url: "controller/index.php/addTienda",
        //    data: datos,
        //    success: function (r) {
        //        Swal.fire(
        //            'Registro exitoso!',
        //            'La tienda se registró correctamente!',
        //            'success'
        //          );
        //    },
        //    error:function(r){
        //        Swal.fire(
        //            'Registro fallido!',
        //            'La tienda no se ha registrado!',
        //            'error'
        //          );
        //    }
        //});
    }

    form.classList.add('was-validated')
  }, false)
})
window.addEventListener("beforeunload", (event) => {
  if(true){
    event.preventDefault();
    event.returnValue = "";
    return "";
  }
});