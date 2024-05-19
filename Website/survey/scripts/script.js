function info() {
    Swal.fire({
        confirmButtonColor: "#0078e7",
        hideClass: {
            backdrop: "swal2-noanimation",
            popup: "animate__animated animate__zoomOut"
        },
        html: "<div style = 'text-align: left'>SDSU's AI student survey was launched campus-wide in the fall 2023 semester. If you use this work, please cite the research at <a href = 'https://it.sdsu.edu/projects-innovation/ai/publications' target = '_BLANK'>this link</a>.</div>",
        showClass: {
            backdrop: "swal2-noanimation",
            popup: "animate__animated animate__zoomIn"
        }
    });
}

function submitForm(form) {
    document.getElementById(form).submit();
}

function reset(form) {
    if (form == "education") {
        document.getElementById("level_").value = "%";
        document.getElementById("year_").value = "%";
        document.getElementById("college").value = "%";
        document.getElementById("time_basis").value = "%";
        document.getElementById("campus").value = "%";
        submitForm("tlform1");
    } else if (form == "background") {
        document.getElementById("age").value = "0";
        document.getElementById("residency").value = "%";
        document.getElementById("living").value = "%";
        document.getElementById("smart_devices").value = "%";
        submitForm("tlform1");
    }
}

$(document).ready(function() {
    $("#table1").DataTable( {
        dom: "Bfrtip",
        buttons: [
            "copyHtml5",
            "excelHtml5",
            "csvHtml5",
            "pdfHtml5"
        ],
        searching: false,
        paging: false,
        info: false
    } );
    $("#table2").DataTable( {
        dom: "Bfrtip",
        buttons: [
            "copyHtml5",
            "excelHtml5",
            "csvHtml5",
            "pdfHtml5"
        ],
        searching: false,
        paging: false,
        info: false
    } );
} );