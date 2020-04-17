$(document).ready(function(){
    var container = $('#ajaxUsers');
    var post = {
        'templateName': templateName,
        'arParams': arParams
    };
    $(document).on('click', '.bx-pagination a', function(event){
        event.preventDefault();
        var arHref = $(this).attr('href').split('?');
        var getUrl = arHref[1];
        $.ajax({
            url: ajaxPath + '?' + getUrl,
            type: "POST",
            data: post,
            success: function(data){
                data = data.replace(new RegExp(ajaxPath, 'g'), window.location.pathname);
                container.empty();
                container.html(data);
            }
        });
    });
    
    //export
    $(document).on('click', '.export-btns a', function(event){
        event.preventDefault();
        var format = $(this).data('format');
        
        if (format) {
            $.ajax({
                url: exportPath + '?format=' + format,
                success: function(data){
                    window.location.href = data;
                }
            });
        }
    });
});
