/**
 * Created by boozz on 2/8/15.
 */
function showAction(id, elem){
    var button = $(elem);
    var trigger = button.closest('tr').hasClass('notActive');
    $.post('/admin-users/usershow',{'id':id, 'act':trigger},function(res){
        if(res.status === 'ok'){
            if(trigger){
                button.closest('tr').removeClass('notActive');
                button.find('span').removeClass('glyphicon-eye-close').addClass('glyphicon-eye-open');

            }else{
                button.closest('tr').addClass('notActive');
                button.find('span').removeClass('glyphicon-eye-open').addClass('glyphicon-eye-close');
            }

        }
    },'JSON');
}

function deleteAction(id, elem){
    var button = $(elem);
    $.post('/admin-users/userdelete',{'id': id}, function(result){
        if(result.status === 'ok'){
            button.closest('tr').remove();
        }
    },'JSON');
}
