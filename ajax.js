// ADD
$(document).on('click', '#btn-add', function(e) {
    $("user_form").validate({
        rules: {
            name: "Username is required",
            email: "Email ID is required",
            gender: "Gender Must Select",
            phone: "Enter 10 digits number",
            course: "Select a course",
            city: "Please enter city name",
            hobbies: "Please select two hobbies"
        },
        name: {
            required: true,
        },
        email: {
            required: true,
        },
        gender: {
            required: true,
        },
        phone: {
            required: true,
        },
        course: {
            required: true,
        },
        city: {
            required: true,
        },
        hobbies: {
            required: true,
        },
        message: {
            name: {
                required: "Please enter a username",
                duplicate_username: "The username you entered is already used"
            },
            email: {
                required: "Please enter a valid Email",
            },
            gender: {
                required: "Select a Gender",
            },
            phone: {
                required: "Please enter 10 digits number"
            },
            course: {
                required: "Please select a course"
            },
            city: {
                required: "Please enter a city name"
            },
            hobbies: {
                required: "Please select two hobbies"
            },
        },
    })
    var data = $("#user_form").serialize();
    // var formData = $("#user_form");
    // var newData = {
    // 	"name": formData.name
    // }
    // console.log("newData");
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(dataResult) {
            // console.log("dataResult", dataResult);
            // console.log("dataResult", dataResult['status']);
            // var result = JSON.parse(dataResult);
            // console.log("da", JSON.parse(dataResult));
            if (dataResult) {
                $('#addEmployeeModal').modal('hide');
                alert('Data added successfully !');
                location.reload();
            }
        }
    });

});


$(document).on('click', '.update', function(e) {
    var id = $(this).attr("data-id");
    var name = $(this).attr("data-name");
    var email = $(this).attr("data-email");
    var gender = $(this).attr("data-gender");
    var phone = $(this).attr("data-phone");
    var course = $(this).attr("data-course");
    var city = $(this).attr("data-city");
    var hobbies = $(this).attr("data-hobbies");
    hobbies = hobbies.split(",");
    console.log(hobbies);
    // console.log("gender", gender);

    $('#id_u').val(id);
    $('#name_u').val(name);
    // $('#Male').setAttribute("checked","checked");
    // $("input:radio[name=Egender]:checked").val("Male");

    $('#email_u').val(email);
    if (gender == 'Male') {
        $("#Male").attr("checked", "checked");
    } else if (gender == 'Female') {
        $("#Female").attr("checked", "checked");
    } else if (gender == 'Others') {
        $("#Others").attr("checked", "checked");
    }

    $('#phone_u').val(phone);
    $('#course_u').val(course);
    $('#city_u').val(city);
    // $('#hobbies_u').val(hobbies);
    for (var i = 0; i < hobbies.length; i++) {
        // if(hobbies[i]=="Cricket" ){
        var hob = hobbies[i].toLowerCase();
        console.log("hobbies", hob.toLowerCase());
        $("#" + hob).attr("checked", "checked");
        // }
    }
});

$(document).on('click', '#update', function(e) {
    var data = $("#update_form").serialize();
    console.log("data", data);
    $.ajax({
        data: data,
        type: "POST",
        url: "save.php",
        success: function(dataResult) {
            if (dataResult) {
                $('#editEmployeeModal').modal('hide');
                alert('Data updated successfully !');
                location.reload();
            }
        }
    });
});


$(document).on("click", ".delete", function() {
    var id = $(this).attr("data-id");
    $('#id_d').val(id);

});
$(document).on("click", "#delete", function() {
    $.ajax({
        url: "save.php",
        type: "POST",
        cache: false,
        data: {
            type: 3,
            id: $("#id_d").val()
        },
        success: function(dataResult) {
            $('#deleteEmployeeModal').modal('hide');
            $("#" + dataResult).remove();

        }
    });
});
$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if (user.length <= 0) {
        alert("Please select records.");
    } else {
        WRN_PROFILE_DELETE = "Are you sure you want to delete " + (user.length > 1 ? "these" : "this") + " row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if (checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "save.php",
                cache: false,
                data: {
                    type: 4,
                    id: selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i = 0; i < ids.length; i++) {
                        $("#" + ids[i]).remove();
                    }
                }
            });
        }
    }
});
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function() {
        if (this.checked) {
            checkbox.each(function() {
                this.checked = true;
            });
        } else {
            checkbox.each(function() {
                this.checked = false;
            });
        }
    });
    checkbox.click(function() {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});