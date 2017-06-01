var url = "http://127.0.0.1:8000/";
var api = url + "api/v1/";

$.ajaxSetup(
    {
        headers:
            {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
    }
);

$(document).on('click','.delete-day',function (e) {
    e.preventDefault();
    var day_id = $(this).val();

    $.ajax({
        type: "DELETE",
        url: api + "days/" + day_id,
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This day has been deleted',
                'success'
            ).then(function () {
                window.location = url + "plans";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.delete-trainee',function (e) {
    e.preventDefault();
    var trainee_id = $(this).val();

    $.ajax({
        type: "DELETE",
        url: api + "trainees/" + trainee_id,
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This trainee has been deleted',
                'success'
            ).then(function () {
                window.location = url + "trainees";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.delete-plan',function (e) {
    e.preventDefault();
    var plan_id = $(this).val();

    $.ajax({
        type: "DELETE",
        url: api + "plans/" + plan_id,
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This plan has been deleted',
                'success'
            ).then(function () {
                window.location = url + "plans";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.delete-exercise',function (e) {
    e.preventDefault();
    var exercise_id = $(this).val();

    $.ajax({
        type: "DELETE",
        url: api + "exercises/" + exercise_id,
        success: function (data) {
            console.log(data);
            $("#exercise" + exercise_id).remove();
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.update-plan',function (e) {
    e.preventDefault();
    var plan_id = $(this).val();
    var name = $('#name').val();

    $.ajax({
        type: "PATCH",
        url: api + "plans/" + plan_id,
        data: {name: name},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This plan has been updated successfully',
                'success'
            ).then(function () {
                window.location = url + "plans";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.create-plan',function (e) {
    e.preventDefault();
    var name = $('#name').val();

    $.ajax({
        type: "POST",
        url: api + "plans/",
        data: {name: name},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'A new plan has been created successfully',
                'success'
            ).then(function () {
                window.location = url + "plans";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.update-trainee',function (e) {
    e.preventDefault();
    var trainee_id = $(this).val();
    var name = $('#name').val();
    var surname = $('#surname').val();
    var email = $('#email').val();
    var birth_year = $('#birth_year').val();

    $.ajax({
        type: "PATCH",
        url: api + "trainees/" + trainee_id,
        data: {name: name, surname: surname, email: email, birth_year: birth_year},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This trainee has been updated successfully',
                'success'
            ).then(function () {
                window.location = url + "trainees";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.create-trainee',function (e) {
    e.preventDefault();
    var name = $('#name').val();
    var surname = $('#surname').val();
    var email = $('#email').val();
    var birth_year = $('#birth_year').val();

    $.ajax({
        type: "POST",
        url: api + "trainees/",
        data: {name: name, surname: surname, email: email, birth_year: birth_year},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'A new trainee has been registered successfully',
                'success'
            ).then(function () {
                window.location = url + "trainees";
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.update-exercise',function (e) {
    e.preventDefault();
    var exercise_id = $(this).val();
    var name = $('#name').val();
    var sets = $('#sets').val();
    var reps = $('#reps').val();
    var rest = $('#rest').val();
    var day_id = $('#day_id').val();

    $.ajax({
        type: "PATCH",
        url: api + "exercises/" + exercise_id,
        data: {name: name, sets: sets, reps: reps, rest: rest},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This exercise has been updated successfully',
                'success'
            ).then(function () {
                window.location = url + "days/" + day_id;
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.create-exercise',function (e) {
    e.preventDefault();
    var name = $('#name').val();
    var sets = $('#sets').val();
    var reps = $('#reps').val();
    var rest = $('#rest').val();
    var day_id = $('#day_id').val();

    $.ajax({
        type: "POST",
        url: api + "exercises/",
        data: {name: name, sets: sets, reps: reps, rest: rest, day_id: day_id},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'A new exercise has been created successfully',
                'success'
            ).then(function () {
                window.location = url + "days/" + day_id;
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.update-day',function (e) {
    e.preventDefault();
    var day_id = $(this).val();
    var name = $('#name').val();
    var plan_id = $('#plan_id').val();

    $.ajax({
        type: "PATCH",
        url: api + "days/" + day_id,
        data: {name: name},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'This day has been updated successfully',
                'success'
            ).then(function () {
                window.location = url + "plans/" + plan_id;
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});

$(document).on('click','.create-day',function (e) {
    e.preventDefault();
    var name = $('#name').val();
    var plan_id = $('#plan_id').val();

    $.ajax({
        type: "POST",
        url: api + "days/",
        data: {name: name, plan_id: plan_id},
        success: function (data) {
            console.log(data);
            swal(
                'Done!',
                'A new day has been created successfully',
                'success'
            ).then(function () {
                window.location = url + "plans/" + plan_id;
            });
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});