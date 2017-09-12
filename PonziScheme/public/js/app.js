$(document).on('click','#edit_user',function() {
    $('#user_id').val($(this).data('user_id'));
    $('#did').val($(this).data('user_id'));
    $('#class_id').val($(this).data('class'));
    $('#is_active').val($(this).data('active'));
    $('#activated').val($(this).data('activated'));
    $('#EditUserModal').modal('show');
});

$(document).on('click','#user_cancel', function () {
    window.confirm('Are you sure you want to cancel transaction? ');
    console.log('clicked');
});

$(document).on('click','#with_modal',function() {
    $('#WithUserModal').modal('show');
});



$('#with_stat').change(function() {
    $('#console-event').html('Toggle: ' + $(this).prop('checked'))
    console.log($(this).prop('checked'));
})