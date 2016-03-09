$(function() {
    $('.dropdown').dropdown();

    $('.action').click(function() {
        var self = $(this);
        var action = self.data('action');
        var job_seekerId = self.parents('tr').data('jobseeker-id');

        if (action == 'edit') {
            $("#test_form").load(Routing.generate('get_jobseeker', { id:
                jobseekerId }), function() {
                $('.dropdown').dropdown();
            });
        } else if (action == 'finish') {
            $.ajax({
                url: Routing.generate('finish_jobseeker', { id: jobseekerId }),
                method: 'PATCH',
                success: function(data) {
                    if (data.status == 'ok') {
                        self.parents('tr').remove();
                    }
                }
            });
        } else if (action == 'delete') {
            $.ajax({
                url: Routing.generate('delete_jobseeker', { id: jobseekerId }),
                method: 'DELETE',
                success: function(data) {
                    if (data.status == 'ok') {
                        self.parents('tr').remove();
                    }
                }
            });
        }

        return false;
    });
});
