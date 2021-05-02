

function modifica(id) {
    var result = (id).split('i');
    var iden = result[1];
    var impiegato =
        {
            "id":  iden,
            "name": "Marco",
            "surname": "Doe",
            "sidi_code": "tasall43",
            "tax_code": "swdwe242"
        };
    var jsonStr = JSON.stringify(impiegato);
    $('#printhere').html(jsonStr);
    $.ajax({
        url: 'http://localhost:80/API-Rest-PHP/API_back-end/student.php/' + id,
        type: 'put',
        data: JSON.stringify(impiegato),
        contentType: 'application/json',
        success: function (result, textStatus, jQxhr) {
            $("#printhere").html(result);
        },
        error: function (jQxhr, textStatus, errorThrown) {
            console.log(errorThrown);
        }
    });
}

$(document).ready(function() {
    aggiorna();
    function aggiorna() {
        var cont = 0;
        $.ajax(
           {
               url: 'http://localhost:80/API-Rest-PHP/API_back-end/student.php',
               method: 'GET',
               contenttype: 'json',
               success: function (data, textStatus, jQxhr) {
				   $("#printhere").html(data);
                    $.each(data.students, function (i, post) {
                        aggiungi(post.id, post.name, post.surname, post.sidi_code, post.tax_code)
                        cont++;
                    });
               },
               error: function (jQxhr, textStatus, errorThrown) {
                   console.log(errorThrown);
               }
           });
        return cont;
    }

    $('#submit').click(function () {
        alert("inserisci");
		$("#printhere").html("ciao");
        var first = $('#first').val();
        var last = $('#last').val();
        var code = $('#posta').val();
        var tax = $('#telefono').val();
        var impiegato =
        {
            "name": first,
            "surname": last,
            "sidi_code": code,
            "tax_code": tax
        };
        $.ajax({
            url: 'http://localhost:80/API-Rest-PHP/API_back-end/student.php',
            type: 'post',
            data: JSON.stringify(impiegato),
            contentType: 'application/json',
            success: function (result, textstatus, jQxhr) {

            }
        });
    });

    $('#bt1').click(function () {
        var size = $("#c div");
        var cont = 0;
        var caselle = new Array();
        var someObj = {};
        someObj.caselle = [];

        $("input:checkbox").each(function () {
            var $this = $(this);
            if ($this.is(":checked")) {
                someObj.caselle.push($this.attr("id"));
                $('#printhere').html("cancella: " + $this.attr("id"));
               cancella($this.attr("id"));
            }
        });
    });

    function cancella(identit) {
        $.ajax(
        {
            url: 'http://localhost:80/API-Rest-PHP/API_back-end/student.php/'+identit,
            method: 'DELETE',
            success: function (data, result) {
				var res = JSON.stringify(data);
                $('#printhere').html("stato: "+result);
            },
            error: function (errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function aggiungi(ID, firstName, lastName, email, phone) {
        var div = document.createElement('div');
        div.className = 'row';
        div.innerHTML = "<div id='d" + ID + "' class='row'>" +
            "<div class='col-md-2'> " + ID + " </div> <div class='col-md-1'> <input name='sottolinea' id=" + ID +
            " type='checkbox' /> </div>" + "<div class='col-md-2'>" + firstName + " " + lastName +
            "</div><div class='col-md-2'>" + email + "</div> <div class='col-md-2'>" + phone +
            "</div>" + "<div class='col-md-2'> <button id='mi" + ID +"' class='mod' type='button' onclick='modifica(this.id)'> mod </button> " +
            "<button id=del" + ID + " class='del' type='button' > del </button> </div><div class='col-md-1'> </div </div>";
        document.getElementById('c').appendChild(div);
    }
});
