

$('#rules>li').each(function () { 
    $(this).on('click', function () { 
        let text = $(this).find('.card-title').text();
        let id = $(this).data('id');
        
        $('.nav-tabs>.nav-item:first-child>.nav-link').removeClass('active');
        $('.tab-pane:first-child').removeClass('active');
        
        $('.nav-tabs .hide').toggleClass('hide');   
        $('.nav-tabs .nav-item:last-child>.nav-link').attr('href', '#rule'+id).addClass('active').text('Syarat: '+text);

        $.get('rule/show/'+id, function (data) {  
            $('.tab-pane:last-child').attr('id', 'rule'+id).addClass('active show').html(data);
        });

     })
 });

 function flash(message, status, action, type)
 {
    return `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
        ${message} <strong>${status}</strong> ${action}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    `
 }

 