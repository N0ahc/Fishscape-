import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$('.like-button').on('click', function() {
    const postId = $(this).data('post-id');
    const isLiked = $(this).data('liked') === 'true';

    $.ajax({
        url: '/likes/store',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            target_id: postId,
            target_type: 'post' // or 'comment' depending on your context
        },
        success: function(response) {
            if (response.success) {
                // Update UI or display a success message
            }
        }
    });
});

$('.unlike-button').on('click', function() {
    const likeId = $(this).data('like-id');

    $.ajax({
        url: '/likes/' + likeId,
        method: 'DELETE',
        data: {
            _token: '{{ csrf_token() }}',
        },
        success: function(response) {
            if (response.success) {
                // Update UI or display a success message
            }
        }
    });
});

