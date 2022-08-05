var statusAjax=false;
jQuery(document).ready(function() {
    CalendarExternalEvents.init();
});

function getDay(date) {
  var day = date.getDate();
  return day < 10 ? '0' + day : '' + day; // ('' + month) for string result
}  
function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
}  
function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month; // ('' + month) for string result
}  
function strtotimeCalendar(date) {
    var dateSplit = date.split(' ');
    var fecha=dateSplit[0].split('-');
    var tiempo=dateSplit[1];
    return fecha[2]+'-'+fecha[1]+'-'+fecha[0]+' '+tiempo;
}

var CalendarExternalEvents = function() {

    var initExternalEvents = function() {


        $('#m_calendar_external_events .fc-event:not(.borrarEvento)').each(function() {
            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                id: 'remove', // use the element's text as the event title
                stick: true, // maintain when user navigates (see docs on the renderEvent method)
                color: $(this).data('color'),
                // description: 'Lorem ipsum dolor eius mod tempor labore'
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });
        });
    }

    var initCalendar = function() {
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendar = $('#m_calendar');

        calendar.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            eventClick: function(event, jsEvent, view) {
                $.ajax({
                    type: "GET",
                    url: '/eventos/' + event.id,
                    dataType: 'json',
                    success: function (data) {
                        updateEvento(data);
                    }
                });
            },
            eventLimit: true, // allow "more" link when too many events
            navLinks: true,
            events: 'eventos/calendar',
            editable: false,
            droppable: true, // this allows things to be dropped onto the calendar

            drop: function(date, jsEvent, ui, resourceId) {
                $('.abrirEventos').click();

                $('#formEvento #motivo_id').val($(this).data('id'));
                $('#formEvento select#motivo_id').trigger('change');

                $('#_formEvento').on('hidden.bs.modal', function () {
                    calendar.fullCalendar('removeEvents','remove');
                })

                // var sdate = $.fullCalendar.moment(date.format());  // Create a clone of the dropped date.
                // sdate.stripTime();        // The time should already be stripped but lets do a sanity check.
                // sdate.time('08:00:00');   // Set a default start time.

                // var edate = $.fullCalendar.moment(date.format());  // Create a clone.
                // edate.stripTime();        // Sanity check.
                // edate.time('12:00:00');   // Set a default end time.

                // $(this).data('event').start = sdate;
                // $(this).data('event').end = edate;

                // // is the "remove after drop" checkbox checked?
                // if ($('#m_calendar_external_events_remove').is(':checked')) {
                //     // if so, remove the element from the "Draggable Events" list
                //     $(this).remove();
                // }
            },

            eventRender: function(event, element) {
                // default render
                if (element.hasClass('fc-day-grid-event')) {
                    element.data('content', event.description);
                    element.data('placement', 'top');
                    mApp.initPopover(element);
                } else if (element.hasClass('fc-time-grid-event')) {
                    element.find('.fc-title').append('<div class="fc-description">' + event.description + '</div>');
                } else if (element.find('.fc-list-item-title').lenght !== 0) {
                    element.find('.fc-list-item-title').append('<div class="fc-description">' + event.description + '</div>');
                }
            }
        });
    }
    var refreshEvents = function() {
        var calendar = $('#m_calendar');
        calendar.fullCalendar('refetchEvents');
    };

    return {
        //main function to initiate the module
        init: function() {
            initExternalEvents();
            initCalendar(); 
        },
        //main function to initiate the module
        initDrag: function() {
            initExternalEvents();
        },
        //main function to initiate the module
        Refresh: function() {
            refreshEvents();
        }

    };
}();