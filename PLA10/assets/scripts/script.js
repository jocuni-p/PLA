
document.querySelector('table#listapersonas').onclick = function (ev) {
    // localizar <tr> más cercana al click
    const tr = ev.target.closest('tr');
    if (!tr) return; // click fuera de filas
    const idpersona = tr.getAttribute('data-id');
    if (!idpersona) return; // fila sin id (cabecera)

    // trasladar y enviar
    document.querySelector('#consulta').value = idpersona;
    document.querySelector('#formconsulta').submit();
}
