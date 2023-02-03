$(document).ready(function() {
    //check if jquery-ui is loaded
    if(jQuery().sortable) {
        jQuery('#task-group').sortable({
            disabled: false,
            axis: 'y',
            update: function (event, ui) {
                const newpriority = ui.item.index() + 1;
                //get the id of the task moved
                const taskId = ui.item.attr('itemid');
                console.log("You moved item to position " + newpriority);
                console.log("You moved item with taskId " + taskId);
                
                //send ajax request to update the priority
                const token = $('meta[name="csrf-token"]').attr('content');
                const url = window.location.origin + '/tasks/' + taskId;

                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        _token: token,
                        name: ui.item.find('a').text(),
                        priority: newpriority > 10 ? 10 : newpriority
                    },
                    success: function (response) {
                        console.log(response.message);
                    }
                });
            }
        });
    }
});
