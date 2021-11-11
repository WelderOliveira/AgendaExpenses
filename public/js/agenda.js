document.addEventListener('DOMContentLoaded', function() {
    let formulario = document.getElementById('form');

    var calendarEl = document.getElementById('agenda');

    var calendar = new FullCalendar.Calendar(calendarEl, {

        initialView: 'dayGridMonth',

        locale:"br",

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth, timeGridWeek, listWeek'
        },

        events: "/calendario/view",

        dateClick:function (info) {
            formulario.reset();

            formulario.start.value = info.dateStr;
            formulario.end.value = info.dateStr;

            $("#evento").modal("show");
        }

    });

    calendar.render();

    document.getElementById("btnSalvar").addEventListener("click",function () {
        const dados = new FormData(formulario);
        console.log(dados);

        axios.post("/calendario",dados).
        then(
            (response)=> {
                calendar.refetchEvents();
                $('#evento').modal("hide");
            }
        ).catch(
            error=>{
                if (error.reponse){
                    console.log(error.reponse.data);
                }
            }
        )
    })
});
