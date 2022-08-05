var introDashboard = introJs().setOptions({
    nextLabel: 'Siguiente', 
    prevLabel: 'Anterior', 
    doneLabel: 'Fin',

    steps: [{
        title: "Bienvenido",
        intro: "Te vamos a dar algunos tips para utilizar el sistema"
    }, {
        title: "Reportes",
        element: document.querySelector('#introReports'),
        intro: "Desde aquí podrás generar los reportes para obtener información de los movimientos en el sistema"
    }, {
        title: "Accesos directos",
        element: document.querySelector('#introShortcuts'),
        intro: "Desde aquí podrás ingresar a las acciones más importantes con solo un click"
    }, {
        title: "Mi perfil",
        element: document.querySelector('#introProfile'),
        intro: "Desde aquí podrás ingresar a la información de tu perfil"
    }, {
        title: "Dashboard",
        element: document.querySelector('#introDashboard'),
        intro: "Desde aquí podrás visualizar los datos más importantes del sistema"
    }, {
        title: "Menú",
        element: document.querySelector('#m_ver_menu'),
        intro: "Desde aquí podrás ingresar a los distintos módulos del sistema"
    }]
});
var isMobile = ('ontouchstart' in document.documentElement && /mobi/i.test(navigator.userAgent));

window.addEventListener('load', function () {
    var doneTour = localStorage.getItem('introDashboard') === 'Completed';
    if (doneTour) {
        return;
    }
    else {
        if(!isMobile) {
            introDashboard.start()
        }

        introDashboard.oncomplete(function () {
            localStorage.setItem('introDashboard', 'Completed');
        });

        introDashboard.onexit(function () {
            localStorage.setItem('introDashboard', 'Completed');
        });
    }
});