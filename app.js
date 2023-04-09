const form = document.getElementById('baby-shower-form');

form.addEventListener('submit', function(event) {
  event.preventDefault();

  const nombre = document.getElementById('nombre').value;
  const correo = document.getElementById('correo').value;
  const telefono = document.getElementById('telefono').value;
  const cantidad = document.getElementById('cantidad').value;
  const mensaje = document.getElementById('mensaje').value;

  fetch('/invitacion', {
    method: 'POST',
    body: new FormData(form)
  })
  .then(response => response.json())
  .then(data => {
    console.log(data);
    alert(data.mensaje);
  })
  .catch(error => {
    console.error(error);
    alert('Ha ocurrido un error al enviar la invitación');
  });
  
  alert(`¡Gracias por confirmar tu asistencia, ${nombre}!`);
});
